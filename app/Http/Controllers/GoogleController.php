<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Repositories\User\UserRepository;

class GoogleController extends Controller
{
    //
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user =  Socialite::driver('google')->stateless()->user();

        $google_user = $this->user->googleCallback($user);

        return response()->json(['google_user' => $google_user ]);
    }
}
