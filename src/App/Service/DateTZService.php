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
     *
     * @param string $timezone
     * @return int
     * @throws Exception
     */
    public function getOffsetFromUTC(string $timezone): int
    {
        return (new \DateTimeZone($timezone))
            ->getOffset(new \DateTime('now', new DateTimeZone('UTC')));
    }

    /**
     *
     * @param string $year
     * @return int
     */
    public function getDaysInFebruaryByYear(string $year): int
    {
        return \DateTime::createFromFormat('Y-m-d', $year . '-02-01')->format('t');
    }
}