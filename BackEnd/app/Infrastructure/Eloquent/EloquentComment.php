<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentComment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Infrastructure\Eloquent\EloquentUser', 'user_id');
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo('App\Infrastructure\Eloquent\EloquentPost', 'post_id');
    }
}