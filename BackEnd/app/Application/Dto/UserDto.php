<?php
namespace App\Domain\DTO;

class UserDTO
{
    private string $name;
    private string $email;
    private string $password;
    private string $profile;
    private string $avatar;
    private string $role;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->profile = $data['profile'] ?? null;
        $this->avatar = $data['avatar'] ?? null;
        $this->role = $data['role'] ?? 'user';
    }
}
