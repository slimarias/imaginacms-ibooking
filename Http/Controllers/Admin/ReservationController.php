<?php

namespace Modules\Ibooking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibooking\Entities\Reservation;
use Modules\Ibooking\Http\Requests\CreateReservationRequest;
use Modules\Ibooking\Http\Requests\UpdateReservationRequest;
use Modules\Ibooking\Repositories\ReservationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

use Modules\Ibooking\Repositories\SlotRepository;
use Modules\Ibooking\Repositories\PlanRepository;

use Modules\Ibooking\Entities\DaysWeek;
use Modules\Ibooking\Entities\ReservationStatus;

//**** Iprofile
use Modules\Iprofile\Repositories\UserApiRepository;
use Modules\Iprofile\Http\Controllers\Api\FieldApiController;
use Modules\Iprofile\Entities\Field;

//**** User
use Modules\User\Repositories\UserRepository;

//**** Import
use Maatwebsite\Excel\Facades\Excel;
use Modules\Ibooking\Imports\ReservationsImport;

use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class ReservationController extends AdminBaseController
{
    /**
     * @var ReservationRepository
     */
    private $reservation;
    private $daysWeek;
    private $slot;
    private $reservationStatus;
    private $plan;
    private $coupon;
    private $user;
    private $userApi;
    private $fieldApi;

    public function __construct(
        ReservationRepository $reservation,
        DaysWeek $daysWeek,
        SlotRepository $slot,
        ReservationStatus $reservationStatus,
        PlanRepository $plan,
        UserRepository $user,
        UserApiRepository $userApi,
        FieldApiController $fieldApi
    )
    {
        parent::__construct();

        $this->reservation = $reservation;
        $this->daysWeek = $daysWeek;
        $this->slot= $slot;
        $this->reservationStatus = $reservationStatus;
        $this->plan = $plan;
        $this->coupon = app('Modules\Ishoppingcart\Repositories\CouponRepository');
        $this->user = $user;
        $this->userApi = $userApi;
        $this->fieldApi = $fieldApi;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $reservations = $this->reservation->all();
        return view('ibooking::admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $daysWeek = $this->daysWeek;
        $slots = $this->slot->all();
        $status = $this->reservationStatus;
        $plans = $this->plan->all();
        $coupons = $this->coupon->all();
        return view('ibooking::admin.reservations.create',compact('daysWeek','slots','status','plans','coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReservationRequest $request
     * @return Response
     */
    public function store(CreateReservationRequest $request)
    {
        $this->reservation->create($request->all());

        return redirect()->route('admin.ibooking.reservation.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibooking::reservations.title.reservations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reservation $reservation
     * @return Response
     */
    public function edit(Reservation $reservation)
    {
        $slots = $this->slot->all();
        $status = $this->reservationStatus;
        $plans = $this->plan->all();
        $coupons = $this->coupon->all();

    
        /*
        $user = $this->userApi->getItem($reservation->customer->id,(object)[
            'take' => false,
            'include' => ['fields']
        ]);
        dd($user);
        */

        $userFields = Field::where("user_id",$reservation->customer->id)->get();
        
        // Fix fields to frontend
        $fields = [];
        if(!empty($userFields) && count($userFields)>0){
            foreach ($userFields as $f) {
                $fields[$f->name] = $f->value;
            }
        }

        return view('ibooking::admin.reservations.edit', compact('reservation','slots','status','plans','coupons','fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Reservation $reservation
     * @param  UpdateReservationRequest $request
     * @return Response
     */
    public function update(Reservation $reservation, UpdateReservationRequest $request)
    {
        $this->reservation->update($reservation, $request->all());

        return redirect()->route('admin.ibooking.reservation.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibooking::reservations.title.reservations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reservation $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        $this->reservation->destroy($reservation);

        return redirect()->route('admin.ibooking.reservation.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibooking::reservations.title.reservations')]));
    }

     /**
     * DataTable Component
     *
     * @param  Reservation $reservation
     * @return Response
     */

    public function searchTable(Request $request)
    {
       
        $query = Reservation::select('id','description','plan','status','created_at');
        return datatables($query)->make(true);
    }

    /**
     * Import view.
     *
     * @param  File $reservations
     * @return Response
     */
    public function indexImport(){
        return view('ibooking::admin.reservations.bulkload.index');
    }

    public function importReservations(Request $request)
    {
        $msg="";
        try {
            $data_excel = Excel::import(new ReservationsImport(), $request->importfile);
            $msg = trans('ibooking::reservations.bulkload.success migrate');
            return redirect()->route('admin.ibooking.reservation.index')
            ->withSuccess($msg);
        } catch (Exception $e) {
            $msg  =  trans('ibooking::reservations.bulkload.error in migrate');
            return redirect()->route('admin.ibooking.reservations.index')
            ->withError($msg);
        }
    }

}
