<?php

namespace App\Packages\Domain\Attendance;

use DateTime;

class Checkout
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
