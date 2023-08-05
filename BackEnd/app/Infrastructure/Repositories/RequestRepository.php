<?php

namespace App\Infrastructure\Repositories;

use App\Enums\CategoryTypeRequestEnum;
use DateTime;

use App\Infrastructure\Eloquent\EloquentRequest;
use App\Interfaces\RequestRepositoryInterface;

class RequestRepository implements RequestRepositoryInterface
{
    protected $model;

    public function __construct(EloquentRequest $model)
    {
        $this->model = $model;
    }
    public function countOvertimeRequestByDate(int $userId, DateTime $datetime): int
    {
        return $this->model->findByUserId($userId)
            ->findByCategoryId(CategoryTypeRequestEnum::OVERTIME_REQUEST)
            ->findByStartFrom($datetime)
            ->count();
    }

    public function getOvertimeDurationByUser(int $userId, DateTime $datetime): ?int
    {
        return $this->model->findByUserId($userId)
            ->findByCategoryId(CategoryTypeRequestEnum::OVERTIME_REQUEST)
            ->findByStartFrom($datetime)
            ->whereNotNull('user_accept_id')
            ->selectRaw('TIMESTAMPDIFF(MINUTE, start_from, ended_at) as overtime_duration')
            ->value('overtime_duration');
    }
}
