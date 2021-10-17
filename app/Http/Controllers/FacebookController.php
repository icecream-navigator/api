<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepository;
use App\Services\SocialService;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{

    private $user, $social;

    public function __construct(UserRepository $user, SocialService $social)
    {
        $this->user   = $user;
        $this->social = $social;
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function handleFacebookCallback()
    {
        $user =  Socialite::driver('facebook')->stateless()->user();

        $facebook_user = $this->user->facebookCallback($user, $this->social);

        return response()->json(['facebook_user' => $facebook_user ]);
    }

}
