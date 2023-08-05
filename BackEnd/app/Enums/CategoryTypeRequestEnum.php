<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class CategoryTypeRequestEnum extends Enum
{
    //------------------REQUEST OFF------------------//
    const REQUEST_OFF = 1;
    const PARENT_REQ_OFF_REGULAR = 11;
    const PARENT_REQ_OFF_REGULAR_TEXT = "Regular";

    const PARENT_REQ_OFF_PERSONAL = 12;
    const PARENT_REQ_OFF_PERSONAL_TEXT = "Personal";
    const TYPE_REQ_OFF_PERSONAL_WEDDING = 121;
    const TYPE_REQ_OFF_PERSONAL_WEDDING_TEXT = "Wedding";
    const TYPE_REQ_OFF_PERSONAL_ANNIVERSARY = 122;
    const TYPE_REQ_OFF_PERSONAL_ANNIVERSARY_TEXT = "Anniversary";

    const PARENT_REQ_OFF_NO_PAID = 14;

    //------------------OVERTIME REQUEST------------------//
    const OVERTIME_REQUEST = 2;
    const PARENT_OVERTIME_REQUEST_TASK = 21;
    const PARENT_OVERTIME_REQUEST_TASK_TEXT = "Task";

    //------------------REQUEST FIX ATTENDANCE------------------//
    const REQUEST_FIX_ATTENDANCE = 3;
}
