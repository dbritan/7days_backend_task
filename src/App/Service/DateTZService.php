<?php

namespace App\Service;

use DateTimeZone;
use Exception;

/**
 *
 */
class DateTZService
{
    /**
     * Method returns timezone offset in minutes
     *
     * @param string $timezone
     * @return int
     * @throws Exception
     */
    public function getOffsetFromUTC(string $timezone): int
    {
        $offset = (new \DateTimeZone($timezone))
            ->getOffset(new \DateTime('now', new DateTimeZone('UTC')));
        return $offset / 60;
    }

    /**
     *
     * @param string $year
     * @return int
     */
    public function getDaysInFebruary(string $year): int
    {
        return \DateTime::createFromFormat('Y-m-d', $year . '-02-01')->format('t');
    }
}