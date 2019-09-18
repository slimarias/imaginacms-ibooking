<?php

namespace Modules\Ibooking\Events;

use Modules\Media\Contracts\DeletingMedia;
use Modules\Ibooking\Entities\Event;

class EventWasDeleted implements DeletingMedia
{
    /**
     * @var Author
     */
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->event->id;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return get_class($this->event);
    }
}
