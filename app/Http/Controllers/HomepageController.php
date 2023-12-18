<?php

namespace App\Http\Controllers;

use App\Models\Professional\CompanyLocation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomepageController extends Controller
{
    public function __invoke(Request $request)
    {
        $companyLocation = CompanyLocation::find($request->get('cl'));

        return Inertia::render('Welcome', [
            'company_location_id' => $companyLocation?->id ?? null,
        ]);
    }
}
