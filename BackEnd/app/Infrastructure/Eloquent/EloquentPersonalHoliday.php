<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloquentPersonalHoliday extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'personal_holidays';
    protected $fillable = ['user_id', 'request_type_id', 'day_left'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class, 'user_id');
    }

    public function requestType(): BelongsTo
    {
        return $this->belongsTo(EloquentRequestType::class, 'request_type_id');
    }
}
