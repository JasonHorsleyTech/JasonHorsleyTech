<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GardenSave extends Model
{
    use HasFactory;

    public $fillable = [
        'garden_id',
        'saved_with',
        'data',
        'autosave',
    ];

    public $casts = [
        'data' => 'array',
    ];

    public function gardens(): BelongsTo
    {
        return $this->belongsTo(Garden::class);
    }

    public function scopeLastSave($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }
}
