<?php

namespace App\Services;

use App\Http\Dto\AttendanceDTO;
use App\Interfaces\HolidayRepositoryInterface;


class HolidayService
{
    private HolidayRepositoryInterface $holidayRepository;

    public function __construct(HolidayRepositoryInterface $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }
    public function checkHoliday(AttendanceDTO $attendanceDTO)
    {
        $countHoliday = $this->holidayRepository->countByCountryCode(
            $attendanceDTO->getCountryCode(),
            $attendanceDTO->getDay(),
            $attendanceDTO->getMonth()
        );

        if ($countHoliday > 0) {
            return true;
        }
        return false;
    }
}
