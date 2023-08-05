<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloquentUser extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'full_name',
        'phone_number',
        'address',
        'img_url',
        'role_id',
        'country_code',
        'department_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(EloquentRole::class, 'role_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(EloquentDepartment::class, 'department_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(EloquentAttendance::class);
    }

    public function workingDayOfWeek(): HasMany
    {
        return $this->hasMany(EloquentWorkingDayOfWeeks::class);
    }

    // Scopes
    protected function scopeSearchByEmail($query, string $email)
    {
        return $query->where('email', $email);
    }

    protected function scopeSearchById($query, int $id)
    {
        return $query->where('id', $id);
    }
}
