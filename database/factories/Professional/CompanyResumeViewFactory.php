<?php

namespace Database\Factories\Professional;

use App\Models\Professional\CompanyResumeView;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyResumeViewFactory extends Factory
{
    protected $model = CompanyResumeView::class;

    public function definition()
    {
        return [
            'company_id' => \App\Models\Professional\Company::factory(),
            'resume_id' => \App\Models\Professional\Resume::factory(),
            'client_ip' => $this->faker->ipv4,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
