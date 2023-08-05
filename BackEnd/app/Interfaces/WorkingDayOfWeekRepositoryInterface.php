<?php

namespace App\Interfaces;

use App\Packages\Domain\TimeWorking\TimeWorking;

interface WorkingDayOfWeekRepositoryInterface
{
    public function countByTimeWorking(int $userId, int $day, string $time): int;

    public function getWorkingTime(int $userId, int $day): ?TimeWorking;
}
