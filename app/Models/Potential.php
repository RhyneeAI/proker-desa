<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Potential extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'description',
        'photo',
        'photo_alt',
    ];
}
