<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Professional\Company;
use App\Models\Professional\CompanyLocation;
use App\Models\Professional\CompanyResumeView;
use App\Models\Professional\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->setupNovaAdmin();

        $this->setupAmazonResume();

        (new LinkedinPostSeeder())->run();
    }

    private function setupNovaAdmin(): void
    {
        User::factory()->create([
            'name' => 'Nova Admin',
            'email' => 'Jason@JasonHorsley.tech',
            'password' => bcrypt('password'),
        ]);
    }

    private function setupAmazonResume(): void
    {
        $this->command->info('Adding seed data for "Amazon resume, company, and location"');

        $files = glob(storage_path('app/public/resumes/*'));
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        file_put_contents(
            storage_path('app/public/resumes/seeded_amazon_resume.txt'),
            "## Resume\nThis is a fake resume for Amazon\n\n### Skills\nCan eat two pizzas all by myself, no NEED for your team."
        );

        $resume = Resume::factory([
            'name' => 'Amazon resume',
            'path' => 'resumes/seeded_amazon_resume.txt',
        ])->create();

        $company = Company::factory([
            'name' => 'Amazon',
            'applied_at' => now()->subDays(5),
            'denied_at' => null,
            'accepted_at' => null,
            'resume_id' => $resume->id,
        ])->create();

        CompanyLocation::factory([
            'company_id' => $company->id,
            'name' => 'Seattle Location',
            'latitude' => 47.6062,
            'longitude' => -122.3321,
        ])->create();
        CompanyLocation::factory([
            'company_id' => $company->id,
            'name' => 'San Francisco Location',
            'latitude' => 37.7749,
            'longitude' => -122.4194,
        ])->create();
        CompanyLocation::factory([
            'company_id' => $company->id,
            'name' => 'New York Location',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
        ])->create();

        CompanyResumeView::factory([
            'company_id' => $company->id,
            'resume_id' => $resume->id,
            'ipinfo' => [
                'client_ip' => '173.244.44.22',
                'latitude' => '40.7128',
                'longitude' => '-74.0060',
            ],
        ])->create();
    }
}
