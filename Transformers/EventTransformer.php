<?php

namespace Modules\Ibooking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class EventTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'title' => $this->when($this->title,$this->title),
      'slug' => $this->when($this->slug,$this->slug),
      'description' => $this->when($this->description,$this->description),
      'summary' => $this->when($this->summary,$this->summary),
      'place' => $this->when($this->place,$this->place),
      'status' => $this->when($this->status,$this->status),
      'statusName' => $this->when($this->present()->status,$this->present()->status),
      'options' => $this->when($this->options,$this->options),
      'duration' => $this->when($this->duration,$this->duration),
      'people' => $this->when($this->people,$this->people),
      'inforprice' => $this->when($this->inforprice,$this->inforprice),
      'video' => $this->when($this->video,$this->video),
      'created_at' => $this->when($this->created_at,$this->created_at),
      'updated_at' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    return $item;
    
  }
}
