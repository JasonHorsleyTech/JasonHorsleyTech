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
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $latitude = $request->ipinfo->latitude;
        $longitude = $request->ipinfo->longitude;

        $closestViewLocation = $this->findClosestCompanyLocation($latitude, $longitude);

        $companyViewFields = [
            'company_id' => null,
            'resume_id' => null,
            'client_ip' => $request->ipinfo->ip,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'ipinfo' => $request->ipinfo,
        ];

        if ($closestViewLocation === null) {
            CompanyResumeView::create($companyViewFields);

            return response()->json([
                'resume' => file_get_contents(Resume::defaultPath())
            ]);
        }

        $companyViewFields['company_id'] = $closestViewLocation->company_id;
        $companyViewFields['resume_id'] = $closestViewLocation->resume_id;

        CompanyResumeView::create($companyViewFields);

        return response()->json([
            // todo: optimize for one cent off your aws bill bucko
            'resume' => file_get_contents($closestViewLocation->company->resume->path)
        ]);
    }

    /**
     * Find closest matching company based on geolocation.
     */
    public function findClosestCompanyLocation(string | null $latitude, string | null $longitude): CompanyLocation | null
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
