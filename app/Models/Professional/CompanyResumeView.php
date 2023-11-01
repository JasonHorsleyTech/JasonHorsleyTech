<?php

namespace App\Models\Professional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyResumeView extends Model
{
    use HasFactory;

    protected $table = 'professional_company_resume_views';
    protected $guarded = [];
    protected $casts = [
        'ipinfo' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
