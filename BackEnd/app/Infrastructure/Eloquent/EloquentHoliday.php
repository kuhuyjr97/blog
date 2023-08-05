<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloquentHoliday extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'holidays';
    protected $fillable = ['name', 'day', 'month', 'country_code'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Scopes
    protected function scopeFindByCountryCode($query, string $countryCode)
    {
        return $query->where('country_code', $countryCode);
    }

    protected function scopeFindByDay($query, int $day)
    {
        return $query->where('day', $day);
    }

    protected function scopeFindByMonth($query, int $month)
    {
        return $query->where('month', $month);
    }
}
