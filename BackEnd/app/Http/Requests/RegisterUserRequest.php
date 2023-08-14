<?php

namespace App\Http\Requests;

use App\Http\Dto\RegisterUserDTO;
use App\Http\Requests\ApiRequest;
use Illuminate\Support\Facades\Hash;

class RegisterUserRequest extends ApiRequest
{
    /**
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {

        return [
            
            'name' => 'required|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|string|confirmed',
        ];
        
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->get('name');
    }
    //*
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->get('email');
    }
    
    public function getPassword(): string
    {
        return Hash::make($this->password); ;
    }

    public function toDTO(): RegisterUserDTO
    {
        return new RegisterUserDTO(
            $this->getName(),
            $this->getEmail(),
            $this->getPassword()
        );
    }
    
}
