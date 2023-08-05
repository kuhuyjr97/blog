<?php
namespace App\Exceptions;

use App\Enums\ResponseEnum;
class UnauthorizedException extends \Exception
{
    public function __construct($message = ResponseEnum::RES_MSG_ERR_LOGIN_FAILED, $code = ResponseEnum::RES_STATUS_LOGIN_FAILED, \Throwable $previous = null )
    {
        parent::__construct($message, $code, $previous);
    }
}
