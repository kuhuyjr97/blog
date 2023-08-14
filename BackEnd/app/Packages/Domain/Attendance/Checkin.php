<?php

namespace App\Packages\Domain\Attendance;

use DateTime;

class Checkin
{
    private DateTime $value;

    public function __construct(DateTime $value)
    {
        $this->value = $value;
    }

    public function toDateTime(): ?DateTime
    {
        return $this->value;
    }
}
