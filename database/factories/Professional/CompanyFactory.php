<?php

namespace Database\Factories\Professional;

use App\Models\Professional\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'applied_at' => $this->faker->dateTimeThisYear,
            'denied_at' => $this->faker->optional()->dateTimeThisYear,
            'accepted_at' => $this->faker->optional()->dateTimeThisYear,
            'resume_id' => null,
        ];
    }
}
