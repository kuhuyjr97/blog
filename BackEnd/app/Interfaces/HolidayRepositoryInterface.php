<?php

namespace App\Interfaces;

interface HolidayRepositoryInterface
{
    public function countByCountryCode(string $countryCode, int $day, int $month): int;
}