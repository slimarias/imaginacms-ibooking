<?php

namespace Modules\Ibooking\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Ibooking\Entities\Reservation;
use Modules\Ibooking\Entities\Plan;
use DateTime;

class ReservationPresenter extends Presenter
{
  
    protected $status;
   
    public function __construct($entity){

        parent::__construct($entity);
        $this->status = app('Modules\Ibooking\Entities\ReservationStatus');
    }

    public function status(){
        return $this->status->get($this->entity->status);
    }

    public function dateF($date,$format){

        $dateReservation = new DateTime($date);
        $dFormat = $dateReservation->format($format);

        return $dFormat;
   
    }

    public function planName($id){
        $plan = Plan::find($id);
        return $plan->title;
    }



    


}
