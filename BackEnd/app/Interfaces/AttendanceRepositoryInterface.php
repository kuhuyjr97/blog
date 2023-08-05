<?php

namespace App\Interfaces;

use App\Packages\Domain\Attendance\Attendance;
use DateTime;

interface AttendanceRepositoryInterface
{
    public function getCheckInCount(int $userId, string $checkIn): int;

    public function create(int $userId, DateTime $checkIn): void;

    public function getAttendanceByCheckInDate(int $userId, string $datetime): ?Attendance;

    public function updateCheckout(int $id, DateTime $checkout): void;
}
