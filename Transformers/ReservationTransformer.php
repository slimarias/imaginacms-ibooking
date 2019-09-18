<?php

namespace Modules\Ibooking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ReservationTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'customeId' => $this->when($this->customer_id,$this->customer_id),
      'description' => $this->when($this->description,$this->description),
      'value' => $this->when($this->value,$this->value),
      'status' => $this->when($this->status,$this->status),
      'statusName' => $this->when($this->present()->status,$this->present()->status),
      'slotId' => $this->when($this->slot_id,$this->slot_id),
      'slot' => $this->when($this->slot->hour,$this->slot->hour),
      'dayId' => $this->when($this->day_id,$this->day_id),
      'startDate' => $this->when($this->start_date,$this->start_date),
      'endDate' => $this->when($this->end_date,$this->end_date),
      'plan' => $this->when($this->plan,$this->plan),
      'planId' => $this->when($this->plan_id,$this->plan_id),
      'people' => $this->when($this->people,$this->people),
      'options' => $this->when($this->options,$this->options),
      'couponId' => $this->when($this->coupon_id,$this->coupon_id),
      'entity' => $this->when($this->entity,$this->entity),
      'entity_id' => $this->when($this->entity_id,$this->entity_id),
      'created_at' => $this->when($this->created_at,$this->created_at),
      'updated_at' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    return $item;
    
  }
}
