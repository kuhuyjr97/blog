<?php

namespace App\Infrastructure\Eloquent;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class EloquentRequest extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'requests';
    protected $fillable = ['user_id', 'user_accept_id', 'accept_time', 'request_type_id', 'category_id', 'status', 'reason', 'start_from', 'ended_at'];
    protected $dates = ['accept_time', 'start_from', 'ended_at', 'created_at', 'updated_at', 'deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class, 'user_id');
    }

    public function userAccept(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class, 'user_accept_id');
    }

    public function requestType(): BelongsTo
    {
        return $this->belongsTo(EloquentRequestType::class, 'request_type_id');
    }

    // Scopes
    protected function scopeFindByUserId($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    protected function scopeFindByStartFrom($query, DateTime $checkIn)
    {
        $checkInDate = Carbon::parse($checkIn)->toDateString();
        return $query->whereDate('start_from', $checkInDate);
    }

    protected function scopeFindByCategoryId($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
