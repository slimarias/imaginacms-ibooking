<?php

namespace Modules\Ibooking\Entities;

class DaysWeek
{
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 7;

    /**
     * @var array
     */
    private $days = [];

    public function __construct()
    {
        $this->days = [
            self::MONDAY => trans('ibooking::common.daysWeek.monday'),
            self::TUESDAY => trans('ibooking::common.daysWeek.tuesday'),
            self::WEDNESDAY => trans('ibooking::common.daysWeek.wednesday'),
            self::THURSDAY => trans('ibooking::common.daysWeek.thursday'),
            self::FRIDAY => trans('ibooking::common.daysWeek.friday'),
            self::SATURDAY => trans('ibooking::common.daysWeek.saturday'),
            self::SUNDAY => trans('ibooking::common.daysWeek.sunday'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->days;
    }

    /**
     * Get the event status
     * @param int $statusId
     * @return string
     */
    public function get($dayId)
    {
        if (isset($this->days[$dayId])) {
            return $this->days[$dayId];
        }

        return $this->days[self::MONDAY];
    }
    
}
