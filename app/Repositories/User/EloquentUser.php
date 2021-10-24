<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Services\AvatarService;

class EloquentUser implements UserRepository
{
	private $model, $avatar;

	public function __construct(User $model, AvatarService $avatar)
	{
		$this->model  = $model;
		$this->avatar = $avatar;
	}

	public function register($request)
	{
		$user = $this->model = User::create($request->validated());

		$this->setAvatar($user);
	}

	public function login($request)
	{
		if (!$token = guard()->attempt($request->validated())) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
		return $this->respondWithToken($token);
	}

	protected function respondWithToken($token)

	{
		return response()->json([
			'access_token' => $token,
			'token_type'   => 'bearer',
		]);

	}

	public function setAvatar($user)
	{
		$this->model->avatar = $this->avatar->generate($user);

		$this->model->save();
	}

	public function googleCallback($user,$social)
	{
		return $social->SocialLogin($user);

	}

	public function facebookCallback($user, $social)
	{
		return $social->SocialLogin($user);
	}

}












?>
