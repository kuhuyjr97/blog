<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Eloquent\EloquentHoliday;
use App\Interfaces\HolidayRepositoryInterface;


class HolidayRepository implements HolidayRepositoryInterface
{
    protected $model;

    public function __construct(EloquentHoliday $model)
    {
        $this->model = $model;
    }
    public function countByCountryCode(string $countryCode, int $day, int $month): int
    {
        return $this->model->findByCountryCode($countryCode)
            ->findByDay($day)
            ->findByMonth($month)
            ->count();
    }
}
