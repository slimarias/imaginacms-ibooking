<?php

namespace Modules\Ibooking\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Ibooking\Presenters\PlanPresenter;

class Plan extends Model
{
    use Translatable,PresentableTrait;

    protected $table = 'ibooking__plans';

    protected $presenter = PlanPresenter::class;

    public $translatedAttributes = [
        'title'
    ];
    protected $fillable = [
        'event_id',
        'status',
        'options'
    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
      'options' => 'array'
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function setOptionsAttribute($value) {
        $this->attributes['options'] = json_encode($value);
    }

    public function getOptionsAttribute($value) {
        return json_decode($value);
    }

}
