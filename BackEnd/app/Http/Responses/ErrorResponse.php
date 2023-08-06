<?php

namespace App\Http\Responses;

class ErrorResponse
{
    protected int $errorStatusCode;
    protected string $message;
    protected int $httpStatusCode;

    public function __construct(int $errorStatusCode, string|array $message, int $httpStatusCode)
    {
        $this->errorStatusCode = $errorStatusCode;
        $this->message = $message;
        $this->httpStatusCode = $httpStatusCode;
    }

    public function json()
    {
        return response()->json([
            'response_status' => $this->errorStatusCode,
            'response_body' => [
                'message' => [
                    'error' => $this->message,
                ]
            ]
        ], $this->httpStatusCode);
    }
}
