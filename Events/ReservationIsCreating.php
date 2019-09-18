<?php

namespace Modules\Ibooking\Events;

use Modules\Ibooking\Entities\Reservation;

class ReservationIsCreating
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

}