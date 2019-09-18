<?php

namespace Modules\Ibooking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibooking\Entities\Slot;
use Modules\Ibooking\Http\Requests\CreateSlotRequest;
use Modules\Ibooking\Http\Requests\UpdateSlotRequest;
use Modules\Ibooking\Repositories\SlotRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class SlotController extends AdminBaseController
{
    /**
     * @var SlotRepository
     */
    private $slot;

    public function __construct(SlotRepository $slot)
    {
        parent::__construct();

        $this->slot = $slot;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$slots = $this->slot->all();

        return view('ibooking::admin.slots.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ibooking::admin.slots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSlotRequest $request
     * @return Response
     */
    public function store(CreateSlotRequest $request)
    {
        $this->slot->create($request->all());

        return redirect()->route('admin.ibooking.slot.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibooking::slots.title.slots')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Slot $slot
     * @return Response
     */
    public function edit(Slot $slot)
    {
        return view('ibooking::admin.slots.edit', compact('slot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Slot $slot
     * @param  UpdateSlotRequest $request
     * @return Response
     */
    public function update(Slot $slot, UpdateSlotRequest $request)
    {
        $this->slot->update($slot, $request->all());

        return redirect()->route('admin.ibooking.slot.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibooking::slots.title.slots')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Slot $slot
     * @return Response
     */
    public function destroy(Slot $slot)
    {
        $this->slot->destroy($slot);

        return redirect()->route('admin.ibooking.slot.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibooking::slots.title.slots')]));
    }

    /**
     * DataTable Component
     *
     * @param  Slot $slot
     * @return Response
     */

    public function searchTable(Request $request)
    {
        $query = Slot::select('id', 'hour');
        return datatables($query)->make(true);
    }

    /**
     * Search Component
     *
     * @param  Slot $slot
     * @return Response
     */

    public function searchSlots()
    {

        $data = array();
        $q = strtolower(Input::get('q'));
       
        $slots = Slot::select('id','hour')
        ->where("hour","like","%{$q}%")
        ->get();

        $data["data"] = $slots;

        return response()->json($data);

    }


}
