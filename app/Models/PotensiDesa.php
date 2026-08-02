<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PotensiDesa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'potensi_desa';

    protected $fillable = [
        'name',
        'category',
        'image',
        'image_alt',
        'description',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
        ];
    }
}
