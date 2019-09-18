<?php

namespace Modules\Ibooking\Entities;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    
    protected $table = 'ibooking__slots';
   
    protected $fillable = [
        'hour'
    ];

    public function days(){
        return $this->belongsToMany(Days::class,'ibooking__day_slot')->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
