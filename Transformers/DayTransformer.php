<?php

namespace Modules\Ibooking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class DayTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'num' => $this->when($this->num,$this->num),
      'dayName' => $this->when($this->present()->name,$this->present()->name),
      'status' => $this->when($this->status,$this->status),
      'statusName' => $this->when($this->present()->status,$this->present()->status),
      'date' => $this->when($this->date,$this->date),
      'events' => EventTransformer::collection($this->whenLoaded('events')),
      'slots' => SlotTransformer::collection($this->whenLoaded('slots')),
      'created_at' => $this->when($this->created_at,$this->created_at),
      'updated_at' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    return $item;
    
  }
}
