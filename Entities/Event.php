<?php

namespace Modules\Ibooking\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Ibooking\Presenters\EventPresenter;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Media\Entities\File;

class Event extends Model
{
    use Translatable,PresentableTrait,MediaRelation;

    protected $table = 'ibooking__events';

    protected $presenter = EventPresenter::class;

    public $translatedAttributes = [
        'title',
        'slug',
        'description',
        'summary'
    ];
    protected $fillable = [
        'place',
        'status',
        'options',
        'duration',
        'people',
        'inforprice',
        'video'
    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
      'options' => 'array'
    ];


    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function days(){
        return $this->belongsToMany(Day::class,'ibooking__day_event')->withTimestamps();
    }

    public function setOptionsAttribute($value) {
        $this->attributes['options'] = json_encode($value);
    }

    public function getOptionsAttribute($value) {
        return json_decode($value);
    }

    public function getMainimageAttribute()
    {

        $thumbnail = $this->files()->where('zone', 'mainimage')->first();

        if ($thumbnail === null) {
            $thumbnail=(object)['path'=>null,'main-type'=>'image/jpeg'];
            return $thumbnail->path='modules/ibooking/img/event/default.jpg';
        }

        return $thumbnail;

    }

    public function getGalleryAttribute(){

        return $this->filesByZone('gallery')->get();

    }

    public function getUrlAttribute() {

        return \URL::route(\LaravelLocalization::getCurrentLocale() . '.ibooking.event.slug',[$this->slug]);

    }




}
