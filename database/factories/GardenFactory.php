<?php

namespace Database\Factories;

use App\Models\GardenSave;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Garden>
 */
class GardenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => 'My Garden',
        ];
    }

    public function withV001()
    {
        return $this->state(function (array $attributes) {
            GardenSave::factory()->v001()->create([
                'garden_id' => $attributes['id'],
            ]);

            return [
                'name' => 'My Garden v001',
            ];
        });
    }
}
