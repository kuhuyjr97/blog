<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class ResponseEnum extends Enum
{
    //------------------200 SUCCESS------------------//
    const HTTP_STATUS_SUCCESS = 200;
    const RES_STATUS_SUCCESS = 2001;
    const RES_MSG_SUCCESS = 'Successfully.';
    //------------------400 ERROR------------------//
    const RES_STATUS_BAD_CHECKIN = 4003;
    const RES_MSG_BAD_CHECKIN_OVERTIME = 'You are not allowed to check in at this time.';
    const RES_MSG_BAD_CHECKIN_HOLIDAY = 'You are not allowed to check in on this day.';
    const RES_STATUS_BAD_CHECKOUT = 4004;
    const RES_MSG_BAD_CHECKOUT_WITHOUT_CHECKIN = 'You have not checked in yet.';

    //------------------401 ERROR------------------//
    const HTTP_STATUS_UNAUTHENTICATED = 401;
    const RES_STATUS_LOGIN_FAILED = 4011;
    const RES_MSG_ERR_LOGIN_FAILED = 'Email or password is incorrect. Please try again.';
    const RES_STATUS_TOKEN_FAILED = 4012;
    const RES_MSG_ERR_TOKEN_FAILED = 'Unauthorized request.';
    //------------------403 ERROR------------------//
    const HTTP_STATUS_FORBIDDEN = 403;
    //------------------409 ERROR------------------//
    const HTTP_STATUS_CONFLICT = 409;
    const RES_STATUS_CONFLICT_CHECKIN = 4091;
    const RES_MSG_ERR_CONFLICT_CHECKIN = 'You have already checked in.';
    const RES_STATUS_CONFLICT_CHECKOUT = 4092;
    const RES_MSG_ERR_CONFLICT_CHECKOUT = 'You have already checked out.';


    //------------------500 ERROR------------------//
    const HTTP_STATUS_ERROR = 500;
    const RES_STATUS_ERROR_OTHER = 5001;
    const RES_MSG_ERR_ERROR_OTHER = 'An unexpected error occurred. Please try again later.';
    const RES_STATUS_ERR_DB = 5002;
    const RES_MSG_ERR_ERROR_DB = 'An unexpected error occurred. Please try again later.';
    const RES_STATUS_ERROR_VALIDATE = 5003;
}
