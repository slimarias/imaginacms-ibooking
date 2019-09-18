<?php

namespace Modules\Ibooking\Events;

use Modules\Media\Contracts\StoringMedia;
use Modules\Ibooking\Entities\Event;

class EventWasUpdated implements StoringMedia
{
    public $event;
    public $data;

    public function __construct(Event $event,array $data)
    {
        $this->event = $event;
        $this->data = $data;
    }

    public function getEntity()
    {
        return $this->event;
    }

    public function getSubmissionData()
    {
        return $this->data;
    }

}