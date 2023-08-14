<?php

namespace App\Packages\Domain\User;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString():string
    {
    return $this->value;
    }
}