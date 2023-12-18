<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $companyLocationId = $request->get('company_location_id');

        $companyLocation = $companyLocationId ?
            CompanyLocation::find($companyLocationId) :
            $this->findClosestCompanyLocationWithinReasonableDistance($request->ipinfo->latitude, $request->ipinfo->longitude);

        if ($companyLocation) {
            $resume = $companyLocation->company->resume;
            $company = $companyLocation->company;

            CompanyResumeView::create([
                'ipinfo' => $request->ipinfo,
                'company_id' => $company->id,
                'resume_id' => $resume->id,
            ]);

            return response()->json([
                'resume' => [
                    'id' => $resume->id,
                    'name' => $resume->name,
                    'content' => file_get_contents($resume->path),
                ],
                'company_name' => $company->name,
            ]);
        } else {
            CompanyResumeView::create(['ipinfo' => $request->ipinfo]);

            return response()->json([
                'resume' => [
                    'id' => null,
                    'name' => 'Default',
                    'content' => file_get_contents(Resume::defaultPath()),
                ],
                'company_name' => null,
            ]);
        }
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

        // Closest distance in continental US is between 72 and 111km per 1 degree of lat/long. We're going to say "below 2" and call it a day
        // If we start applying to Norwegian jobs, maybe it's time for the "siney siney" function, or whatever the hell it was called.
        if ($closestDistance > 2) return null;

        return $closestLocation;
    }
}
