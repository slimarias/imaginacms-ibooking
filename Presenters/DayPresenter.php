<?php

namespace Modules\Ibooking\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Ibooking\Entities\Status;
use Modules\Ibooking\Entities\DaysWeek;

class DayPresenter extends Presenter
{
  
    protected $status;
    protected $daysWeek;

    public function __construct($entity){

        parent::__construct($entity);
        $this->status = app('Modules\Ibooking\Entities\Status');
        $this->daysWeek = app('Modules\Ibooking\Entities\DaysWeek');
    }

    public function name(){
        return $this->daysWeek->get($this->entity->num);
    }

    public function status(){
        return $this->status->get($this->entity->status);
    }

    public function statusLabelClass(){
        switch ($this->entity->status){

            case Status::DISABLED:
                return 'bg-red';
                break;

            case Status::ENABLED:
                return 'bg-green';
                break;

            default:
                return 'bg-red';
                break;

        }
    }


}
