<?php

namespace Modules\Ibooking\Events;

use Modules\Ibooking\Entities\Plan;

class PlanWasCreated
{
    public $plan;
    public $data;

    public function __construct(Plan $plan,array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
    }

}