<?php

namespace Modules\Ibooking\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Ibooking\Entities\Event;
use Modules\Ibooking\Entities\EventStatus;

class EventPresenter extends Presenter
{
  
    protected $status;
    
    public function __construct($entity){

        parent::__construct($entity);
        $this->status = app('Modules\Ibooking\Entities\EventStatus');

    }

    public function status(){
        return $this->status->get($this->entity->status);
    }

    public function statusLabelClass(){
        switch ($this->entity->status) {
            case Status::DRAFT:
                return 'bg-red';
                break;
            case Status::PENDING:
                return 'bg-orange';
                break;
            case Status::PUBLISHED:
                return 'bg-green';
                break;
            case Status::UNPUBLISHED:
                return 'bg-purple';
                break;
            default:
                return 'bg-red';
                break;
        }
    }


}
