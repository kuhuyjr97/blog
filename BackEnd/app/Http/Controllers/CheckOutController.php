<?php

namespace App\Http\Controllers;

use App\Enums\ResponseEnum;
use App\Exceptions\ConflictException;
use App\Exceptions\ForbiddenException;
use App\Http\Requests\AttendanceRequest;
use App\Services\AttendanceService;

class CheckOutController extends Controller
{

    private AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function store(AttendanceRequest $request)
    {
        try {
            $user = $request->user();

            $this->attendanceService->checkOut($request->toDTO($user->id, $user->country_code));
            return response()->json([
                'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
                'response_body' => [],
            ]);
        } catch (ForbiddenException $e) {
            return response()->json([
                'response_status' => $e->getCode(),
                'response_body' => [
                    'message' => [
                        'error' => $e->getMessage(),
                    ]
                ]
            ], ResponseEnum::HTTP_STATUS_FORBIDDEN);
        } catch (ConflictException $e) {
            return response()->json([
                'response_status' => $e->getCode(),
                'response_body' => [
                    'message' => [
                        'error' => $e->getMessage(),
                    ]
                ]
            ], ResponseEnum::HTTP_STATUS_CONFLICT);
        }
    }
}
