<?php

namespace App\Services;

use App\Http\Dto\AttendanceDTO;
use App\Interfaces\WorkingDayOfWeekRepositoryInterface;


class WorkingDayService
{
    private WorkingDayOfWeekRepositoryInterface $workingDayOfWeekRepository;

    public function __construct(WorkingDayOfWeekRepositoryInterface $workingDayOfWeekRepository)
    {
        $this->workingDayOfWeekRepository = $workingDayOfWeekRepository;
    }
    public function checkNotWorkingTime(AttendanceDTO $attendanceDTO)
    {
        $countRecordWorkingTime = $this->workingDayOfWeekRepository->countByTimeWorking(
            $attendanceDTO->getUserId(),
            $attendanceDTO->getDayOfWeek(),
            $attendanceDTO->getTime()
        );

        if ($countRecordWorkingTime === 0) {
            return true;
        };

        return false;
    }

    public function getWorkingTime(AttendanceDTO $attendanceDTO)
    {
        return $this->workingDayOfWeekRepository->getWorkingTime(
            $attendanceDTO->getUserId(),
            $attendanceDTO->getDayOfWeek()
        );
    }
}
