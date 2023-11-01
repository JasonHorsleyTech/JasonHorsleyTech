<?php

namespace Database\Factories\Professional;

use App\Models\Professional\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    protected $model = Resume::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'path' => $this->faker->fileExtension,
        ];
    }
}
