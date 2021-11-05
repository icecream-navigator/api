<?php

namespace App\Repositories\Vote;

use App\Models\Vote;

class EloquentVote implements VoteRepository
{
	private $model;

	public function __construct(Vote $model)
	{
		$this->model = $model;
	}

	public function store($user, $icecream_id)
	{

		$this->model->icecream_id = $icecream_id;
		$this->model->user_id     = $user->id;

		$this->model->saveOrFail();
	}
}

?>
