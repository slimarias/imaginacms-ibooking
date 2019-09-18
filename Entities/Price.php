<?php

namespace Modules\Ibooking\Entities;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    
    protected $table = 'ibooking__prices';
    protected $fillable = [
        'plan_id',
        'price',
        'people'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}
