<?php

namespace Modules\Ibooking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class SlotTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'hour' => $this->when($this->hour,$this->hour),
      'created_at' => $this->when($this->created_at,$this->created_at),
      'updated_at' => $this->when($this->updated_at,$this->updated_at),
    ];
    
    return $item;
    
  }
}
