<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaterPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'start_latitude',
        'start_longitude',
        'end_latitude',
        'end_longitude',
        'recommend_latitude',
        'recommend_longitude',
        'direction',
        'debit',
        'documentation_photos',
        'interpretation_photos',
    ];

    protected function casts(): array
    {
        return [
            'start_latitude' => 'decimal:7',
            'start_longitude' => 'decimal:7',
            'end_latitude' => 'decimal:7',
            'end_longitude' => 'decimal:7',
            'recommend_latitude' => 'decimal:7',
            'recommend_longitude' => 'decimal:7',
            'documentation_photos' => 'array',
            'interpretation_photos' => 'array',
        ];
    }
}
