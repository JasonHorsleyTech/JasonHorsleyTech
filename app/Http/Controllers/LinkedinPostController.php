<?php

namespace App\Http\Controllers;

use App\Models\LinkedinPost;
use Illuminate\Http\Request;

class LinkedinPostController extends Controller
{
    public function index() {
        return view('linkedin-posts.index', [
            'posts' => LinkedinPost::orderBy('generated_at', 'desc')->select('id', 'content', 'generated_at', 'posted_at')->get(),
            'can_post_to_linkedin' => auth()->user()->oauthToken?->isExpired() === false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LinkedinPost $post)
    {
        $post->delete();

        return redirect()->route('linkedin-posts.index');
    }
}
