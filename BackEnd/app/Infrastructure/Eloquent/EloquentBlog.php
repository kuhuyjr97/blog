<?php
namespace App\Infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElouentBlog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'category_id',
        'content',
        'user_id',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo('App\Infrastructure\Eloquent\EloquentUser','user_id');
    }
    public function category():BelongsTo
    {
        return $this->belongsTo('App\Infrastructure\Eloquent\EloquentCategory','category_id');
    }
}