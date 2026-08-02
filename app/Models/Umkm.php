<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umkm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'owner_name',
        'category',
        'description',
        'phone',
        'address',
        'latitude',
        'longitude',
        'photo',
        'photo_alt',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }
}
