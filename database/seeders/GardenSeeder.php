<?php

namespace Database\Seeders;

use App\Models\Garden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GardenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Garden::factory()->withV001()->create([
            'user_id' => 1,
            'name' => 'My Garden',
        ]);
    }
}
