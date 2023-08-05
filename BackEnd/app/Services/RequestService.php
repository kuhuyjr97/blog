<?php

namespace App\Services;

use App\Http\Dto\AttendanceDTO;
use App\Interfaces\RequestRepositoryInterface;


class RequestService
{

	private RequestRepositoryInterface $requestRepository;
	public function __construct(RequestRepositoryInterface $requestRepository)
	{
		$this->requestRepository = $requestRepository;
	}
	public function checkNotRequest(AttendanceDTO $attendanceDTO)
	{
		$result = $this->requestRepository->countOvertimeRequestByDate(
			$attendanceDTO->getUserId(),
			$attendanceDTO->getDatetime(),
		);

		if ($result === 0) {
			return true;
		}
		return false;
	}

	public function calculateTimeOverRequest(AttendanceDTO $attendanceDTO)
	{
		$result = $this->requestRepository->getOvertimeDurationByUser(
			$attendanceDTO->getUserId(),
			$attendanceDTO->getDatetime(),
		);

		if (!$result) {
			return 0;
		}
		return $result;
	}
}
