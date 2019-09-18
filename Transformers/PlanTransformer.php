<?php

namespace Modules\Ibooking\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Ibooking\Transformers\EventTransformer;

class PlanTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'title' => $this->when($this->title,$this->title),
      'eventId' => $this->when($this->event_id,$this->event_id),
      'event' => new EventTransformer($this->whenLoaded('event')),
      'status' => $this->when($this->status,$this->status),
      'statusName' => $this->when($this->present()->status,$this->present()->status),
      'options' => $this->when($this->options,$this->options),
      'created_at' => $this->when($this->created_at,$this->created_at),
      'updated_at' => $this->when($this->updated_at,$this->updated_at),
      'prices' => PriceTransformer::collection($this->whenLoaded('prices'))
    ];
    
    return $item;
    
  }
}
