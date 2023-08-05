<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class UpdateSourceEnum extends Enum
{
    const UPDATE_SOURCE_ORIGINAL = 1;
    const UPDATE_SOURCE_UPDATED = 2;
}
