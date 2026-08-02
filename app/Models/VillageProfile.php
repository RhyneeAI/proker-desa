<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_name',
        'history',
        'vision',
        'mission',
        'address',
        'area_size',
        'population',
        'logo',
        'logo_alt',
        'cover_image',
        'cover_image_alt',
        'map_embed',
        'border_north',
        'border_south',
        'border_east',
        'border_west',
        'org_chart_image',
        'bpd_chart_image',
    ];

    protected function casts(): array
    {
        return [
            'area_size' => 'decimal:2',
            'population' => 'integer',
        ];
    }
}
