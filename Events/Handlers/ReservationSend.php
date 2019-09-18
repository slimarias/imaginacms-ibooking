<?php

namespace Modules\Ibooking\Events\Handlers;

use Illuminate\Contracts\Mail\Mailer;

use Modules\Ibooking\Emails\Reservation;

class ReservationSend
{
   
    /**
     * @var Mailer
     */
    private $mail;
    private $setting;

    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
        $this->setting = app('Modules\Setting\Contracts\Setting');
    }

    public function handle($event)
    {
        $reservation = $event->reservation;
        $data = $event->data;
        
        if(isset($data['notify'])){
            $subject = trans("ibooking::common.email.subject")." ".$reservation->present()->status." #".$reservation->id."-".time();
            $view = "ibooking::emails.Reservation";
            
            // Send User
            //$this->mail->to($reservation->customer->email)->send(new Reservation($reservation,$subject,$view));
            
            // Send Admin
            $email_to = explode(',',$this->setting->get('ibooking::form-emails'));

            $this->mail->to($email_to[0])->send(new Reservation($reservation,$subject,$view));

        }

    }

    

}
