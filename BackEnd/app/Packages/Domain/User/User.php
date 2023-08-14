<?php

namespace App\Packages\Domain\User;

class User
{
    private Name $name;
    private Email $email;

    public function __construct(Name $name, Email $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}