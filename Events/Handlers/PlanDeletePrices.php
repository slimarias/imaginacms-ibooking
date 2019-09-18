<?php

namespace Modules\Ibooking\Events\Handlers;

use Modules\Ibooking\Entities\Price;

class PlanDeletePrices
{
   
   
    public function __construct()
    {
       
    }

    public function handle($event)
    {

        $plan = $event->plan;
        
        if(count($plan->prices)>0){
            $plan->prices()->delete();
        }
       
    }

}
