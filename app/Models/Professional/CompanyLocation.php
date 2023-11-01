<?php

namespace App\Models\Professional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    use HasFactory;

    protected $table = 'professional_company_locations';
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getResumePathAttribute(): string
    {
        return $this->company->resume->path;
    }
}
