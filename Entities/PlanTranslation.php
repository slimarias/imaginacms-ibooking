<?php

namespace Modules\Ibooking\Entities;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    protected $table = 'ibooking__plan_translations';
}
