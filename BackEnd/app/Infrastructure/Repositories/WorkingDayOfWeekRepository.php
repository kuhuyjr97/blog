<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Eloquent\EloquentWorkingDayOfWeeks;
use App\Interfaces\WorkingDayOfWeekRepositoryInterface;
use App\Packages\Domain\TimeWorking\TimeWorking;
use DateTime;

class WorkingDayOfWeekRepository implements WorkingDayOfWeekRepositoryInterface
{
    protected $model;

    public function __construct(EloquentWorkingDayOfWeeks $model)
    {
        $this->model = $model;
    }

    public function countByTimeWorking(int $userId, int $day, string $time): int
    {
        return $this->model::findByUserId($userId)
            ->findByDayOfWeek($day)
            ->findByWorkTime($time)
            ->count();
    }

    public function getWorkingTime(int $userId, int $day): ?TimeWorking
    {
        $result = $this->model->findByUser($userId)
            ->findByDay($day)
            ->first(['time_start_work', 'time_end_work']);

        return $result ? new TimeWorking(
            DateTime::createFromFormat('H:i:s', $result->time_start_work),
            DateTime::createFromFormat('H:i:s', $result->time_end_work)
        ) : null;
    }
}
