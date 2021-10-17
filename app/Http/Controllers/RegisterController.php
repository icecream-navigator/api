<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;

class RegisterController extends Controller
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->user = $user;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create(
            $request->validated(),
        );

        $this->user->setAvatar($user);

        return response()->json(['message' => $user], 200, [],JSON_UNESCAPED_SLASHES, JSON_NUMERIC_CHECK);

    }

    public function guard()
    {
        return Auth::guard('api');
    }
}


