<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloquentDepartment extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'location',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class);
    }
}
