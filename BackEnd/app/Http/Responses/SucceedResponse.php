<?php

namespace App\Http\Responses;

class SucceedResponse
{

    protected int $statusCode;
    protected string $message;
    protected int $httpStatusCode;

    public function __construct(int $statusCode, string $message, int $httpStatusCode)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->httpStatusCode = $httpStatusCode;
    }

    public function json(array $responseBody)
    {
        return response()->json([
            'response_status' => $this->statusCode,
            'response_body' => $responseBody

        ], $this->httpStatusCode);
    }
}
