<?php

namespace App\Repositories\User;

interface UserRepository
{
	public function setAvatar($user);

	public function googleCallback($user);
}













?>
