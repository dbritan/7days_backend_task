<?php

namespace App\Service;

use DateTimeInterface;
use DateTimeZone;
use Exception;

/**
 *
 */
class DateTZService
{
    /**
     *
     * @param DateTimeZone $timeZone
     * @return int
     * @throws Exception
     */
    public function getTimeZoneOffset(DateTimeZone $timeZone): int
    {
        return $timeZone->getOffset(new \DateTime('now', new DateTimeZone('UTC')));
    }

    /**
     *
     * @param DateTimeZone $timeZone
     * @return int
     * @throws Exception
     */
    public function getTimeZoneOffsetInMinutes(DateTimeZone $timeZone): int
    {
        return $this->getTimeZoneOffset($timeZone) / 60;
    }

    /**
     *
     * @param DateTimeInterface $date
     * @return int
     */
    public function getDaysInFebruary(DateTimeInterface $date): int
    {
        return (clone $date)->modify('first day of february')->format('t');
    }

    /**
     *
     * @param DateTimeInterface $date
     * @return int
     */
    public function getDaysInMonth(DateTimeInterface $date): int
    {
        return $date->format('t');
    }

    /**
     *
     * @param DateTimeInterface $date
     * @return string
     */
    public function getNameOfMonth(DateTimeInterface $date): string
    {
        return $date->format('F');
    }

}