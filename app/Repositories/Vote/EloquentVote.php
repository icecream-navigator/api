<?php

namespace App\Repositories\Vote;

use App\Models\Vote;
use App\Models\Icecream;

class EloquentVote implements VoteRepository
{
	private $model;

	public function __construct(Vote $model)
	{
		$this->model = $model;
	}

	public function store($user, $icecream_id)
	{
		$icecream = Icecream::findOrFail($icecream_id);


		$this->model->icecream_id = $icecream_id;
		$this->model->user_id     = $user->id;

		$this->model->saveOrFail();

		$votes = $this->model->where('icecream_id', $icecream_id)->count();

		$icecream->votes = $votes;

		$icecream->update();
	}
}

?>
