<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class EloquentAttendance extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'note',
        'update_source',
        'timework',
        'overtime',
        'time_late',
    ];

    protected $dates = [
        'check_in',
        'check_out',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class, 'user_id');
    }

    // Scopes
    protected function scopeFindByUserId($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    protected function scopeSearchByCheckInDate($query, string $checkIn)
    {
        $checkInDate = Carbon::parse($checkIn)->toDateString();

        return $query->whereDate('check_in', $checkInDate);
    }

    protected function scopeFindById($query, int $id)
    {
        return $query->where('id', $id);
    }
}
