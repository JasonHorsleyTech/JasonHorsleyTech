<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OauthToken;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToLinkedIn()
    {
        $user = auth()->user();
        $user->oauthToken()?->delete();

        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback()
    {
        $user = Socialite::driver('linkedin')->user();
        $token = $user->token;
        $expiresAt = now()->addSeconds($user->expiresIn);

        OauthToken::created([
            'user_id' => auth()->id(),
            'provider' => 'linkedin',
            'access_token' => encrypt($token),
            'expires_at' => $expiresAt,
            'refresh_token' => encrypt($user->refreshToken),
        ]);
    }
}
