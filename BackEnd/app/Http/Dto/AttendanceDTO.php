<?php

namespace App\Http\Dto;

use DateTime;

class AttendanceDTO
{
    private int $userId;
    private DateTime $datetime;
    private string $countryCode;

    public function __construct(int $userId, DateTime $datetime, string $countryCode)
    {
        $this->userId = $userId;
        $this->datetime = $datetime;
        $this->countryCode = $countryCode;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getDay(): int
    {
        return (int) $this->datetime->format('d');
    }

    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    public function getMonth(): int
    {
        return (int) $this->datetime->format('m');
    }

    public function getYear(): int
    {
        return (int) $this->datetime->format('Y');
    }

    public function getHour(): int
    {
        return (int) $this->datetime->format('H');
    }

    public function getDayOfWeek(): int
    {
        return (int) $this->datetime->format('N');
    }

    public function getTime(): string
    {
        return $this->datetime->format('H:i:s');
    }

    public function getFormattedDateTime(): string
    {
        return $this->datetime->format('Y-m-d');
    }
}
