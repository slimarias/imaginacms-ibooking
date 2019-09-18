<?php

namespace Modules\Ibooking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

// Modules
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Setting\Contracts\Setting;

// Ibooking
use Modules\Ibooking\Repositories\EventRepository;
use Modules\Ibooking\Repositories\PlanRepository;
use Modules\Ibooking\Repositories\ReservationRepository;

// Events
use Modules\Ibooking\Events\ReservationWasCreated;

// Ishoppingcart
use Modules\Ishoppingcart\Repositories\CouponRepository;

// Supports
use Modules\Ibooking\Support\Coupon as couponSupport;

//Request
use Modules\Ibooking\Http\Requests\CreateReservationFrontRequest;

use Modules\Iprofile\Entities\Field;

class PublicController extends BasePublicController
{
    /**
     * @var Repository
     */

    private $event;
    private $plan;
    private $reservation;
    private $eventSlot;
    private $coupon; 
    private $setting;
   
    public function __construct(
        EventRepository $event, 
        PlanRepository $plan, 
        ReservationRepository $reservation, 
        CouponRepository $coupon, 
        Setting $setting
    )
    {
        parent::__construct();
        $this->event = $event;
        $this->plan = $plan;
        $this->reservation = $reservation;
        $this->coupon = $coupon;
        $this->setting=$setting;
        
    }


     /**
     * View Index
     *
     * @return Response
     */
    public function index()
    {

        $tpl = 'ibooking::frontend.index';
        $ttpl='ibooking.index';

        if(view()->exists($ttpl)) $tpl = $ttpl;

        $events = $this->event->all();

        return view($tpl, compact('events'));

    }

    /**
     * View Show
     *
     * @return Response
     */
    public function show($slug)
    {

        $tpl = 'ibooking::frontend.show';
        $ttpl='ibooking.show';

        if(view()->exists($ttpl)) $tpl = $ttpl;

        $event = $this->event->findBySlug($slug);

        $this->reservation->clearReservation();

        return view($tpl, compact('event'));


    }

    /**
     * View Giftcard
     *
     * @return Response
     */

    public function giftcard($eventslug){

        $tpl = 'ibooking::frontend.giftcard.index';
        $ttpl='ibooking.giftcard.index';

        if(view()->exists($ttpl)) $tpl = $ttpl;

        $event = $this->event->findBySlug($eventslug);

        return view($tpl, compact('event'));

    }

    
    /**
     * Create Reservation
     *
     * @return Response
     */
    public function reservationCreate(CreateReservationFrontRequest $request){
        
        $data = $request->all();
        
        try{
    
            \DB::beginTransaction();

            //Check the price with plan and number people
            $priceBD = $this->plan->checkPrice($data);

            // If Price is a fail
            if(!$priceBD)
                return redirect()->back();
            
            // Reservation Pending
            $data["status"] = 2; 

            // Check Coupon
            if(isset($data["coupon_code"]) && !empty($data["coupon_code"])) {
                $supportCoupon = new couponSupport();
                $data = $supportCoupon->getValueReservation($data);
            }

            //Create
            $reservation = $this->reservation->create($data);

            \DB::commit(); //Commit to Data Base

            //The pay was with the coupon and full
            if($data["value"]==0){
                $this->sendEmail($reservation,$data);
                return redirect()->route("homepage");
            }else{
                $request->session()->put('reservationID', $reservation->id);
                return redirect()->route(locale().'.checkout');
            }

        } catch (\Exception $e) {

            //dd($e);
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            
            return redirect()->back();
        }

    }

    
     /**
     * Send Email (Ishoppingcart Module)
     *
     * @return Response
     */
    public function sendEmail($reservation,$data){

        $email_from = $this->setting->get('iforms::from-email');
        $email_to = explode(',',$this->setting->get('ibooking::form-emails'));
        $sender  = $this->setting->get('core::site-name');

        $order = "R".$reservation->id."C".$data["couponInfor"];
        
        $content=['order'=>$order,'reservation'=>$reservation];
        
        $mail = emailSend(['email_from'=>[$email_from],'theme' => 'ibooking::emails.success_order','email_to' => $reservation->customer->email,'subject' => 'Confirmación de pago de orden', 'sender'=>$sender, 'data' => array('title' => 'Confirmación de pago de orden','intro'=>'Felicidades su reservación fue exitosa','content'=>$content)]);
        $mail = emailSend(['email_from'=>[$email_from],'theme' => 'ishoppingcart::email.success_order','email_to' => $email_to,'subject' => 'Confirmación de pago de orden', 'sender'=>$sender, 'data' => array('title' => 'Confirmación de pago de orden','intro'=>'Confirmación de Nueva Orden','content'=>$content)]);
        
    }


    // Just Testing
    public function testingEmailNew(){
        

        $reservation = $this->reservation->find(1320);
        
        $userFields = Field::where("user_id",$reservation->customer->id)->get();
        
        // Fix fields to frontend
        $fields = [];
        if(!empty($userFields) && count($userFields)>0){
            foreach ($userFields as $f) {
                $fields[$f->name] = $f->value;
            }
        }

        $content =[ 
            'order' => 123,
            'reservation'=>$reservation,
            'fields'=> $fields
        ];
        
        $emailTo = "wavutes@gmail.com";
        $sender  = $this->setting->get('core::site-name');
        $email_from = $this->setting->get('iforms::from-email');

       //exit();
       /*
        $mail = emailSend([
            'email_from'=> [$email_from],
            'theme' => 'ibooking::emails.success_order',
            'email_to' => $emailTo,
            'subject' => 'Confirmación de pago de orden', 
            'sender'=>$sender, 
            'data' => array(
                'title' => 'Confirmación de pago de orden',
                'intro'=>'Felicidades su reservación fue exitosa',
                'content'=>$content)]
            );
        */

        //dd($mail);
       
        /*
        $confimail = emailSend([
             'email_from'=>[$email_from],
             'theme' => 'ishoppingcart::email.success_order',
             'email_to' => $emailTo,
             'subject' => 'Confirmación de Nueva Orden', 
             'sender'=>$sender, 
             'data' => array(
                 'title' => 'Confirmación de Nueva Orden',
                 'intro'=>'Nueva reservación Realizada',
                 'content'=>$content,)]
        );
        */

        //dd($confimail);
            
    }
   

}