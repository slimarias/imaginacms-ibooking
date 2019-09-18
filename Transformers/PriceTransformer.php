<?php

namespace Modules\Ibooking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PriceTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'planId' => $this->when($this->plan_id,$this->plan_id),
      'plan' => new PlanTransformer($this->whenLoaded('plan')),
      'price' => $this->when($this->price,$this->price),
      'people' => $this->when($this->people,$this->people),
      'created_at' => $this->when($this->created_at,$this->created_at),
      'updated_at' => $this->when($this->updated_at,$this->updated_at),
    ];
    
    return $item;
    
  }
}
