<?php

namespace App\Services;

use App\Enums\ResponseEnum;
use App\Http\Dto\RegisterUserDTO;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UnauthorizedException;
use App\Interfaces\EloquentUserRepositoryInterface;


class AuthService
{
    private EloquentUserRepositoryInterface $EloquenUserRepositoryInterface;
    public function __construct(EloquentUserRepositoryInterface $EloquenUserRepositoryInterface)
    {
        $this->EloquenUserRepositoryInterface = $EloquenUserRepositoryInterface;
    }

    public function register(RegisterUserDTO $registerUserDTO)
    {
        // $this->EloquenUserRepositoryInterface->saveNewUser($registerUserDTO->getName(), $registerUserDTO->getEmail(),$registerUserDTO->getPassword());
        $this->EloquenUserRepositoryInterface->

    }
    
   
}
