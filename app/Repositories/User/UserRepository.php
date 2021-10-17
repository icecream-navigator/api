<?php

namespace App\Repositories\User;

use App\Services\SocialService;

interface UserRepository
{
	public function setAvatar($user);

	public function googleCallback($user, SocialService $social);

	public function facebookCallback($user, SocialService $social);
}













?>
