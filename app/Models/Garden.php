<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Garden extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'name',
    ];

    public function saves(): HasMany
    {
        return $this->hasMany(GardenSave::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lastSave(): GardenSave
    {
        return $this->saves()->orderBy('created_at', 'desc')->first();
    }
}
