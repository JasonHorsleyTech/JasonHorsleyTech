<?php

namespace Database\Factories\Professional;

use App\Models\Professional\CompanyLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyLocationFactory extends Factory
{
    protected $model = CompanyLocation::class;

    public function definition()
    {
        return [
            'company_id' => \App\Models\Professional\Company::factory(),
            'name' => $this->faker->streetName,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
