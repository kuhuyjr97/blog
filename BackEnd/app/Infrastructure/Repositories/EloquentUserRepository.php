<?php
namespace App\Infrastructure\Repositories;

use App\Interfaces\EloquentUserRepositoryInterface;
use App\Infrastructure\Eloquent\EloquentUser;

class EloquentUserRepository implements EloquentUserRepositoryInterface
{
    public function findByEmail(string $email): ?EloquentUser
    {
        return EloquentUser::where('email', $email)->first();
    }
}
