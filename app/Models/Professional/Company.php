<?php

namespace App\Models\Professional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'professional_companies';

    public $timestamps = true;
    
    protected $casts = [
        'applied_at' => 'datetime',
        'denied_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    protected $guarded = [];

    public function locations()
    {
        return $this->hasMany(CompanyLocation::class);
    }

    public function views()
    {
        return $this->hasMany(CompanyResumeView::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
