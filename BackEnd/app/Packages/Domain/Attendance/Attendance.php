<?php

namespace App\Packages\Domain\Attendance;

use DateTime;

class Attendance
{
    private AttendanceId $id;
    private ?Checkout $checkout;
    private ?Checkin $checkin;

    public function __construct(
        AttendanceId $attendanceId,
        ?Checkout $checkout,
        ?Checkin $checkin
    ) {
        $this->id = $attendanceId;
        $this->checkout = $checkout;
        $this->checkin = $checkin;
    }

    public function id(): int
    {
        return $this->id->toInt();
    }

    public function checkout(): ?DateTime
    {
        return $this->checkout ? $this->checkout->toDateTime() : null;
    }

    public function checkin(): ?DateTime
    {
        return $this->checkin ? $this->checkin->toDateTime() : null;
    }

    public function toArray(): array
    {
        return [
            'attendanceId' => $this->id(),
            'checkout' => $this->checkout(),
            'checkin' => $this->checkin(),
        ];
    }
}

namespace App\Packages\Domain\Attendance;

use DateTime;

class Checkin
{
    private ?DateTime $value;

    public function __construct(?DateTime $value)
    {
        $this->value = $value;
    }

    public function toDateTime(): ?DateTime
    {
        return $this->value;
    }
}

namespace App\Packages\Domain\Attendance;

use DateTime;

class Checkout
{
    private ?DateTime $value;

    public function __construct(?DateTime $value)
    {
        $this->value = $value;
    }

    public function toDateTime(): ?DateTime
    {
        return $this->value;
    }
}
