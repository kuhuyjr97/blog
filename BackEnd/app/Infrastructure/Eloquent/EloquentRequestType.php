<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloquentRequestType extends Model
{
    use SoftDeletes, HasFactory;


    protected $table = 'request_types';
    protected $fillable = ['parent_id', 'category_id', 'name', 'description'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function parent()
    {
        return $this->belongsTo(EloquentRequestType::class, 'parent_id');
    }
}
