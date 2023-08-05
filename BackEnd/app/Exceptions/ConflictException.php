<?php

namespace App\Exceptions;

use App\Enums\ResponseEnum;
use Throwable;

class ConflictException extends \Exception
{
    public function __construct($message = ResponseEnum::RES_MSG_ERR_CONFLICT_CHECKIN, $code = ResponseEnum::RES_STATUS_CONFLICT_CHECKIN, Throwable $previous = null)
    {
        parent::__construct($message, $code);
    }
}
