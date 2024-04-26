<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;

class DateTZInfoFormModel
{
    /**
     * @Assert\NotBlank(),
     * @Assert\Date()
     */
    public string $date;

    /**
     * @Assert\NotBlank(),
     * @Assert\Timezone(),
     */
    public string $timezone;
}