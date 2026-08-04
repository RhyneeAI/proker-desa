<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Official extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'parent_id',
        'photo',
        'photo_alt',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
            'parent_id' => 'integer',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function descendantIds(): array
    {
        $ids = [];
        $toCheck = [$this->id];

        while ($toCheck) {
            $childIds = self::query()->whereIn('parent_id', $toCheck)->pluck('id')->all();
            if (! $childIds) {
                break;
            }
            $ids = array_merge($ids, $childIds);
            $toCheck = $childIds;
        }

        return $ids;
    }
}
