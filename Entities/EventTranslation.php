<?php

namespace Modules\Ibooking\Entities;

use Illuminate\Database\Eloquent\Model;

class EventTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'summary'
    ];
    protected $table = 'ibooking__event_translations';


    protected function setSlugAttribute($value){

        if(!empty($value)){
            $this->attributes['slug'] = str_slug($value,'-');
        }else{
            $this->attributes['slug'] = str_slug($this->title,'-');
        }

    }
    
    protected function setDescriptionAttribute($value){

        if(!empty($this->summary) && !is_null($this->summary)){
            $this->attributes['summary'] = $this->summary;
        }else{
            $this->attributes['summary'] = substr(strip_tags($value),0,150);
            
        }

        $this->attributes['description'] = $value;
    }


}
