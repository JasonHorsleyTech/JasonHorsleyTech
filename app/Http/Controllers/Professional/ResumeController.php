<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professional\Company;
use App\Models\Professional\CompanyLocation;
use App\Models\Professional\CompanyResumeView;
use App\Models\Professional\Resume;

class ResumeController extends Controller
{
    /**
     * Find and return whatever resume I submitted to the company requesting it (or a default if no match)
     *
     * - Get IP from ipinfo
     * - Get latitude and longitude from ipinfo
     * - Find closest company location to latitude and longitude
     * - Return the submitted resume, or bail to default resume.
     */
    public function __invoke(Request $request)
    {
        $companyLocation = $this->findAndTrackCompanyLocation($request);

        if ($companyLocation === null) {
            $resume = [
                'id' => null,
                'name' => 'Default',
                'content' => file_get_contents(Resume::defaultPath()),
            ];
        } else {
            $resume = [
                'id' => $companyLocation->resume_id,
                'name' => $companyLocation->resume->name,
                'content' => file_get_contents($companyLocation->resume->path),
            ];
        }

        return response()->json([
            'resume' => $resume,
            'company_name' => $companyLocation?->company?->name,
        ]);
    }

    /**
     * List all resumes
     */
    public function index()
    {
        return response()->json([
            'resumes' => Resume::select('id', 'name')->get()
        ]);
    }

    /**
     * Get markdown for specific resume
     */
    public function show(Resume $resume)
    {
        return response()->json([
            'id' => $resume->id,
            'name' => $resume->name,
            'content' => file_get_contents($resume->path),
        ]);
    }

    /**
     * Track a company requesting a resume
     */
    private function findAndTrackCompanyLocation(Request $request, ?Resume $resume = null): CompanyLocation | null
    {
        if (!$resume) {
            $closestViewLocation = $this->findClosestCompanyLocationWithinReasonableDistance($request->ipinfo->latitude, $request->ipinfo->longitude);
        }

        $companyViewFields = [
            'company_id' => null,
            'resume_id' => null,
            'ipinfo' => $request->ipinfo,
        ];

        if ($closestViewLocation === null) {
            CompanyResumeView::create($companyViewFields);
        } else {
            CompanyResumeView::create(array_merge($companyViewFields, [
                'company_id' => $closestViewLocation->company_id,
                'resume_id' => $closestViewLocation->resume_id,
            ]));
        }

        return $closestViewLocation;
    }

    /**
     * Find closest matching company based on geolocation.
     */
    private function findClosestCompanyLocationWithinReasonableDistance(string | null $latitude, string | null $longitude): CompanyLocation | null
    {
        if ($latitude === null || $longitude === null || CompanyLocation::count() === 0) {
            return null;
        }

        $closestLocation = null;
        $closestDistance = PHP_INT_MAX;

        foreach (CompanyLocation::all() as $companyLocation) {
            // "Manhattan distance". Not great, not terrible.
            $distance = abs($latitude - $companyLocation->latitude) + abs($longitude - $companyLocation->longitude);

            if ($distance < $closestDistance) {
                $closestDistance = $distance;
                $closestLocation = $companyLocation;
            }
        }

        // Closest distance in continental US is between 72 and 111km per 1 degree of lat/long. We're going to say "below 1" and call it a day
        // If we start applying to Norwegian jobs, maybe it's time for the "siney siney" function, or whatever the hell it was called.
        if ($closestDistance > 1) return null;

        return $closestLocation;
    }
}
