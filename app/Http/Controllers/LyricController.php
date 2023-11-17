<?php

namespace App\Http\Controllers;

class LyricController extends Controller
{
    public function __invoke(string $song)
    {
        try {
            $markdown = file_get_contents(resource_path("lyrics/{$song}.md"));
            return response()->json([
                'markdown' => $markdown,
            ]);
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
