<?php

namespace Modules\Ibooking\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Ibooking\Presenters\ReservationPresenter;

class Reservation extends Model
{
   
    use PresentableTrait;

    protected $table = 'ibooking__reservations';

    protected $presenter = ReservationPresenter::class;

    protected $fillable = [
        'customer_id',
        'description',
        'value',
        'status',
        'slot_id',
        'day_id',
        'start_date',
        'end_date',
        'plan',
        'plan_id',
        'people',
        'options',
        'coupon_id',
        'entity',
        'entity_id'
    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
      'options' => 'array'
    ];

    public function customer(){
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User",'customer_id');
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function setOptionsAttribute($value) {
        $this->attributes['options'] = json_encode($value);
    }

    public function getOptionsAttribute($value) {
        return json_decode($value);
    }

}
