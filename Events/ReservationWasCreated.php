<?php

namespace Modules\Ibooking\Events;

use Modules\Ibooking\Entities\Reservation;

class ReservationWasCreated
{
    public $reservation;
    public $data;

    public function __construct(Reservation $reservation,array $data)
    {
        $this->reservation = $reservation;
        $this->data = $data;
    }

}