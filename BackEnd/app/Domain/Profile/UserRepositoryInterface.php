<?php

namespace App\Domain\Profile;

use App\Packages\Domain\User\User;
use Illuminate\Database\Eloquent\Collection;
use App\Infrastructure\Eloquent\EloquentUser;

interface EloquentUserRepositoryInterface
{
    public function findByEmail(string $email): ?EloquentUser;

    public function saveNewUser(string $name, string $email, string $password);
}
