<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Services\AvatarService;
use JWTAuth;

class EloquentUser implements UserRepository
{
	private $model, $avatar;

	public function __construct(User $model, AvatarService $avatar)
	{
		$this->model = $model;
		$this->avatar = $avatar;
	}

	public function setAvatar($user)
	{
		$this->model->avatar = $this->avatar->generate($user);

		$this->model->save();
	}

	public function googleCallback($user)
	{
		$name           = $user->getName();
		$avatar         = $user->getAvatar();
		$email          = $user->getEmail();


		$this->model = User::where([
			'name'           => $name,
			'email'          => $email,
			'avatar'         => $avatar,
		])->first();


		$user = User::firstOrCreate([
			'name'           => $name,
			'email'          => $email,
			'avatar'         => $avatar,
		]);

		$token = JWTAuth::fromUser($user);

		return [
			'access_token'   => $token,
			'name'           => $name,
			'email'          => $email,
			'avatar'         => $avatar,
		];

	}
}












?>
