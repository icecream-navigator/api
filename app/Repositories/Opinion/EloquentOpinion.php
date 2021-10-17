<?php

namespace App\Repositories\Opinion;

use App\Models\Opinion;
use App\Models\Stall;

class EloquentOpinion implements OpinionRepository
{
	private $model;

	public function __construct(Opinion $model)
	{
		$this->model = $model;
	}

	public function store($user, $stall_id, array $attributes)
	{
		Stall::findOrFail($stall_id);

		$this->model->author = $user->name;
		$this->model->author_avatar = $user->avatar;
		$this->model->stall_id = $stall_id;

		$this->model->fill($attributes);

		$this->model->save();
	}
}










?>
