<?php

namespace App\Exceptions;

use App\Enums\ResponseEnum;
use Throwable;

class ForbiddenException extends \Exception
{
	public function __construct($message = ResponseEnum::RES_MSG_BAD_CHECKIN_OVERTIME, $code = ResponseEnum::RES_STATUS_BAD_CHECKIN, Throwable $previous = null)
	{
		parent::__construct($message, $code);
	}
}
