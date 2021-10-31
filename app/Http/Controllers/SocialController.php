<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Repositories\User\UserRepository;
use App\Services\SocialService;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    //
    private $user, $social;

    public function __construct(UserRepository $user, SocialService $social)
    {
        $this->user   = $user;
        $this->social = $social;
    }

    public function handleProviderCallback(Request $reqeust)
    {
        $token    = $reqeust->input('_token');
        $provider = $reqeust->input('_provider');

        $user =  Socialite::driver($provider)->stateless()->userFromToken($token);

        $social_user = $this->user->providerCallback($user, $this->social);

        return response()->json(['social_user' => $social_user]);
    }
}
