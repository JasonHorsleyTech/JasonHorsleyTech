<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GardenSave>
 */
class GardenSaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'garden_id' => 1,
            'saved_with' => '0.0.1',
            'data' => [],
        ];
    }

    public function v001()
    {
        return $this->state(function (array $attributes) {
            return [
                'saved_with' => '0.0.1',
                'data' => [
                    'garden' => [
                        'name' => 'My Garden',
                        'width' => 10,
                        'height' => 10,
                        'grid' => []
                    ]
                ],
            ];
        });
    }
}
