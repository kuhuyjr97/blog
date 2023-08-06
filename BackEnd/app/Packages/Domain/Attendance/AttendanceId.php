<?php

namespace App\Packages\Domain\Attendance;

class AttendanceId
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toInt(): int
    {
        return $this->value;
    }
}
