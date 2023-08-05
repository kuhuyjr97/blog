<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloquentWorkingDayOfWeeks extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'working_day_of_weeks';

    protected $fillable = [
        'user_id',
        'day',
        'time_start_work',
        'time_end_work',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class, 'user_id');
    }

    // Scopes
    protected function scopeFindByUserId($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }


    protected function scopeFindByDayOfWeek($query, int $day)
    {
        return $query->where('day', $day);
    }

    protected function scopeFindByWorkTime($query, string $time)
    {
        return $query->whereTime('time_end_work', '>', $time);
    }
}
