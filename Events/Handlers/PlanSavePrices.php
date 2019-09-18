<?php

namespace Modules\Ibooking\Events\Handlers;

use Modules\Ibooking\Entities\Price;

class PlanSavePrices
{
   
   
    public function __construct()
    {
       
    }

    /*
        listPrices => [
            {"price":1,"people":"12"},
            {"price":2,"people":"20"}
        ]
    */
    public function handle($event)
    {

        $plan = $event->plan;
        $data = $event->data;

        if(isset($data["listPrices"])){
            $listPrices = json_decode($data["listPrices"]);
            foreach($listPrices as $infor){
                
                $price = new Price([
                    'price' => $infor->price,
                    'people' => $infor->people
                ]);
                $plan->prices()->save($price);
            }
        }
       
      
    }

    

}
