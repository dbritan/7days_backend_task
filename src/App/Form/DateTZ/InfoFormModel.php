<?php

namespace App\Form\DateTZ;

use DateTime;
use DateTimeZone;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
class InfoFormModel
{
    /**
     * @Assert\NotBlank(),
     * @Assert\Type("DateTimeInterface")
     */
    public ?DateTime $date;

    /**
     * @Assert\NotBlank(),
     * @Assert\Type("DateTimeZone")
     */
    public ?DateTimeZone $timeZone;
}