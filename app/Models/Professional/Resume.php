<?php

namespace App\Models\Professional;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
            get: fn (?string $value) => $value ? Storage::disk('public')->path($value) : null,
        );
    }

    public static function defaultResumeContent(): string
    {
        return file_get_contents(resource_path('resumes/default.md'));
    }

    public function getResumeContent(): string
    {
        return file_get_contents($this->path);
    }
}
