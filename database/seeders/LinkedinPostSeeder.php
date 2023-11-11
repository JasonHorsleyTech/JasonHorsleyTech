<?php

namespace Database\Seeders;

use App\Models\LinkedinPost;
use Illuminate\Database\Seeder;

class LinkedinPostSeeder extends Seeder
{
    public function run()
    {
        LinkedinPost::factory(5)->create();
    }
}
