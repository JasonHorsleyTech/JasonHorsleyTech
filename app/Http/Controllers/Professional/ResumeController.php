<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // TODO: Get IP address
        $markdown = file_get_contents(resource_path('resumes/default.md'));
        return response()->json([
            'resume' => $markdown
        ]);
    }
}
