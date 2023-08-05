<?php

namespace App\Interfaces;

use DateTime;


interface RequestRepositoryInterface
{
	public function countOvertimeRequestByDate(int $userId, Datetime $datetime): int;

	public function getOvertimeDurationByUser(int $userId, Datetime $datetime): ?int;
}
