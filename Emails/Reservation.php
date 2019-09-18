<?php

namespace Modules\Ibooking\Emails;

use Illuminate\Mail\Mailable;


use Modules\Ibooking\Repositories\ReservationRepository;

class Reservation extends Mailable
{
   

    public $reservation;
    public $subject;
    public $view;

    public function __construct($reservation,$subject,$view)
    {
        $this->reservation = $reservation;
        $this->subject = $subject;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->view($this->view)
            ->subject($this->subject);
    }
}
