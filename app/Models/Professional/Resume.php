<?php

namespace App\Models\Professional;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $table = 'professional_resumes';
    protected $guarded = [];

    public function views()
    {
        return $this->hasMany(CompanyResumeView::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function path(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => resource_path("resumes/{$value}"),
        );
    }

    public static function defaultPath(): string
    {
        return resource_path('resumes/default.md');
    }
}
