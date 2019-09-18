<?php

namespace Modules\Ibooking\Entities;

class ReservationStatus
{
    const DECLINED = 0;
    const APPROVED = 1;
    const PENDING = 2;
    const EXPIRED = 3;
    const ERROR = 4;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DECLINED => trans('ibooking::common.reservationStatus.declined'),
            self::APPROVED => trans('ibooking::common.reservationStatus.approved'),
            self::PENDING => trans('ibooking::common.reservationStatus.pending'),
            self::EXPIRED => trans('ibooking::common.reservationStatus.expired'),
            self::ERROR => trans('ibooking::common.reservationStatus.error'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the reservation status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::PENDING];
    }
}
