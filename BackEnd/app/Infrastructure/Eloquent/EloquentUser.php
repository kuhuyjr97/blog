<?php

namespace App\Infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EloquentUser extends Model 
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'avatar',
        'role',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function blogs(): HasMany 
    {
        return $this->hasMany('App\Infrastructure\Eloquent\EloquentBlog','user_id');
    }

    public function comments(): HasMany 
    {
        return $this->hasMany('App\Infrastructure\Eloquent\EloquentComment','user_id');
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
   

}