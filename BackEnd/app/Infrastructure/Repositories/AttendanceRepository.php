<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Eloquent\EloquentAttendance;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Packages\Domain\Attendance\Attendance;
use App\Packages\Domain\Attendance\AttendanceId;
use App\Packages\Domain\Attendance\Checkin;
use App\Packages\Domain\Attendance\Checkout;
use DateTime;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    protected $model;

    public function __construct(EloquentAttendance $model)
    {
        $this->model = $model;
    }

    public function getCheckInCount(int $userId, string $checkIn): int
    {
        return $this->model->findByUserId($userId)
            ->searchByCheckInDate($checkIn)
            ->count();
    }

    public function create(int $userId, DateTime $checkIn): void
    {
        $this->model::create([
            'user_id' => $userId,
            'check_in' => $checkIn,
            'update_source' => 1,
        ]);
    }

    public function getAttendanceByCheckInDate(int $userId, string $datetime): ?Attendance
    {
        $result = $this->model->findByUserId($userId)->searchByCheckInDate($datetime)->first(['id', 'check_out', 'check_in']);

        return $result ? new Attendance(
            new AttendanceId($result->id),
            new Checkout($result->check_out ?? null),
            new Checkin($result->check_in ?? null),
        ) : null;
    }

    public function updateCheckout(int $id, DateTime $checkout): void
    {
        $this->model->findById($id)->update([
            'check_out' => $checkout,
        ]);
    }
}
