<?php

use App\Http\Controllers\Professional\ResumeController;
use App\Models\Professional\CompanyLocation;
use App\Models\Professional\Resume;

it('returns the default resume if no company or locations present', function () {
    // Breaks if we ever mess with RefreshDB on pest.php
    $this->expect(CompanyLocation::count())->toBe(0);

    $response = $this->get('/api/professional/resume');
    $response->assertJson([
        'resume' => file_get_contents(Resume::defaultPath())
    ]);
});

it('returns the tampa resume for tampa IP', function () {
    $controller = new ResumeController();

    $tampaLocation = CompanyLocation::factory()->create(['name' => 'Tampa Location', 'latitude' => 27.9506, 'longitude' => -82.4572]);
    $seattleLocation = CompanyLocation::factory()->create(['name' => 'Seattle Location', 'latitude' => 47.6062, 'longitude' => -122.3321]);

    $tampaResume = Resume::factory()->create(['name' => 'Tampa Resume']);
    $seattleResume = Resume::factory()->create(['name' => 'Seattle Resume']);

    $tampaLocation->company->update(['resume_id' => $tampaResume->id]);
    $seattleLocation->company->update(['resume_id' => $seattleResume->id]);

    $location = $controller->findClosestCompanyLocation('28.0000', '-82.5000');
    expect($location?->id)->toBe($tampaLocation->id);
});

it('returns default resume if too far from any known company locations', function () {
    $controller = new ResumeController();

    $tampaLocation = CompanyLocation::factory()->create(['name' => 'Hong Kong Location', 'latitude' => 22.3193, 'longitude' => 114.1694]);
    $seattleLocation = CompanyLocation::factory()->create(['name' => 'Madrid Location', 'latitude' => 40.4168, 'longitude' => -3.7038]);

    $tampaResume = Resume::factory()->create(['name' => 'Hong Kong Resume']);
    $seattleResume = Resume::factory()->create(['name' => 'Madrid Location']);

    $tampaLocation->company->update(['resume_id' => $tampaResume->id]);
    $seattleLocation->company->update(['resume_id' => $seattleResume->id]);

    $location = $controller->findClosestCompanyLocation('27.0000', '-82.0000');
    expect($location)->toBe(null);
});
