<?php

namespace App\Http\Controllers\Tracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function post(Request $request, $id)
    {
        $video = Video::find($id);
        $video->views++;
        $video->save();
        return response()->json([
            'message' => 'success'
        ]);
    }
}
