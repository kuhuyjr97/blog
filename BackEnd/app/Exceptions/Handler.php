<?php

namespace App\Exceptions;

use App\Enums\ResponseEnum;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Exception $e, Request $request) {
            Log::error('error', ['message', $e->getMessage()]);
            Log::error('stackTrace', $e->getTrace());

            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'response_status' => ResponseEnum::RES_STATUS_TOKEN_FAILED,
                    'response_body' => [
                        'message' => [
                            'error' => ResponseEnum::RES_MSG_ERR_TOKEN_FAILED,
                        ]
                    ],
                ], ResponseEnum::HTTP_STATUS_UNAUTHENTICATED);
            }
            if ($e instanceof QueryException) {
                Log::error('Database error: ' . $e->getMessage());
                return response()->json([
                    'response_status' => ResponseEnum::RES_STATUS_ERR_DB,
                    'response_body' => [
                        'message' => ["error" => ResponseEnum::RES_MSG_ERR_ERROR_DB],
                    ],
                ], ResponseEnum::HTTP_STATUS_ERROR);
            }

            return response()->json([
                'response_status' => ResponseEnum::RES_STATUS_ERROR_OTHER,
                'response_body' => [
                    'message' => ResponseEnum::RES_MSG_ERR_ERROR_OTHER,
                ],
            ], ResponseEnum::HTTP_STATUS_ERROR);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
