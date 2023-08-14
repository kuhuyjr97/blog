<?php

namespace App\Packages\Domain\User;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    
}