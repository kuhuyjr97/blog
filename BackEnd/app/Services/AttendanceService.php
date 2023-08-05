<?php

namespace App\Services;

use App\Enums\ResponseEnum;
use App\Exceptions\ConflictException;
use App\Exceptions\ForbiddenException;
use App\Http\Dto\AttendanceDTO;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Packages\Domain\Attendance\Attendance;
use DateTime;

class AttendanceService
{
    private WorkingDayService $workingDayService;
    private AttendanceRepositoryInterface $attendanceRepository;
    private RequestService $requestService;
    private HolidayService $holidayService;

    public function __construct(WorkingDayService $workingDayService, AttendanceRepositoryInterface $attendanceRepository, RequestService $requestService, HolidayService $holidayService)
    {
        $this->workingDayService = $workingDayService;
        $this->attendanceRepository = $attendanceRepository;
        $this->requestService = $requestService;
        $this->holidayService = $holidayService;
    }
    public function checkIn(AttendanceDTO $attendanceDTO)
    {
        if ($this->isCheckIn($attendanceDTO)) {
            throw new ConflictException();
        }

        if ($this->workingDayService->checkNotWorkingTime($attendanceDTO)) {
            if ($this->requestService->checkNotRequest($attendanceDTO)) {
                throw new ForbiddenException();
            }
        }

        if ($this->holidayService->checkHoliday($attendanceDTO)) {
            if ($this->requestService->checkNotRequest($attendanceDTO)) {
                throw new ForbiddenException(ResponseEnum::RES_MSG_BAD_CHECKIN_HOLIDAY);
            }
        }

        $this->attendanceRepository->create(
            $attendanceDTO->getUserId(),
            $attendanceDTO->getDatetime()
        );
    }

    public function isCheckIn(AttendanceDTO $attendanceDTO)
    {
        $countRecordLogin = $this->attendanceRepository->getCheckInCount(
            $attendanceDTO->getUserId(),
            $attendanceDTO->getFormattedDateTime()
        );

        if ($countRecordLogin > 0) {
            return true;
        };
        return false;
    }

    public function checkOut(AttendanceDTO $attendanceDTO)
    {
        $attendance = $this->attendanceRepository->getAttendanceByCheckInDate(
            $attendanceDTO->getUserId(),
            $attendanceDTO->getFormattedDateTime()
        );

        if (!$attendance) {
            throw new ForbiddenException(ResponseEnum::RES_MSG_BAD_CHECKOUT_WITHOUT_CHECKIN, ResponseEnum::RES_STATUS_BAD_CHECKOUT);
        }

        if ($attendance->checkout()) {
            throw new ConflictException(ResponseEnum::RES_MSG_ERR_CONFLICT_CHECKOUT, ResponseEnum::RES_STATUS_CONFLICT_CHECKOUT);
        }
        // $workingTime = $this->workingDayService->getWorkingTime($attendanceDTO);

        // $overtimeRequest = $this->requestService->calculateTimeOverRequest($attendanceDTO);
        // $timeOver = 0;

        // if ($overtimeRequest > 0) {
        //     if ($workingTime) {
        //         $earlyTime = max(0, $workingTime->timeStart()->getTimestamp() - $attendance->checkin()->getTimestamp());
        //         $overtime = max(0, $attendanceDTO->getDatetime()->getTimestamp() - $workingTime->timeEnd()->getTimestamp());

        //         $timeOverReal = ($earlyTime + $overtime) / 60;
        //         $timeOver = min($timeOverReal, $overtimeRequest);
        //     } else {
        //         $timeOverReal = max(0, $attendance->checkin()->getTimestamp() - $attendance->checkout()->getTimestamp());
        //         $timeOver = min($timeOverReal, $overtimeRequest) / 60;
        //     }
        // }

        // $lateTime = ceil(max(0, ($attendance->checkin()->getTimestamp() - $workingTime->timeStart()->getTimestamp()) / 60) / 30) * 30;
        // $earlyTime = ceil(max(0, ($workingTime->timeEnd()->getTimestamp() - $attendanceDTO->getDatetime()->getTimestamp()) / 60) / 30) * 30;

        // // dump($lateTime);
        // // dump($earlyTime);
        // $timeLate = ($lateTime + $earlyTime) / 60;

        // $workTime = max(0, ($workingTime->timeEnd()->getTimestamp() - $workingTime->timeStart()->getTimestamp()) / 3600 - 1 - $timeLate);

        // $this->attendanceRepository->updateAttendance(
        //     $attendance->id(),
        //     $attendanceDTO->getFormattedDateTime(),
        //     $timeLate,
        //     $workTime,
        //     $timeOver,
        // );

        $this->attendanceRepository->updateCheckout(
            $attendance->id(),
            $attendanceDTO->getDatetime(),
        );
    }
}
