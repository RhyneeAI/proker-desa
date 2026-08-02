<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Official extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'photo_alt',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
        ];
    }
}
