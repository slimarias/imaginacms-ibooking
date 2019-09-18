<?php

namespace Modules\Ibooking\Events;

use Modules\Ibooking\Entities\Plan;

class PlanWasDeleted
{
    public $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

}