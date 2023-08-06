<?php

namespace App\Infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquenReaction extends Model
{
    protected $table = 'reactions';
    protected $fillable = [
        'user_id',
        'blog_id',
        'type',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo('App\Infrastructure\Eloquent\EloquentUser', 'user_id');
    }
    public function blog(): BelongsTo {
        return $this->belongsTo('App\Infrastructure\Eloquent\EloquentBlog', 'blog_id');
    }

}