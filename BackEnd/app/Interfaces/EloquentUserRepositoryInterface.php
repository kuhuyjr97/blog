<?php

namespace App\Interfaces;

use App\Infrastructure\Eloquent\EloquentUser;

interface EloquentUserRepositoryInterface
{
    public function findByEmail(string $email): ?EloquentUser;
}
