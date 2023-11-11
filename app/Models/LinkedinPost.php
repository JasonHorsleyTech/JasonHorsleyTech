<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'generated_at',
        'posted_at',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'posted_at' => 'datetime',
    ];

    public function scopePosted($query)
    {
        return $query->whereNotNull('posted_at');
    }
}
