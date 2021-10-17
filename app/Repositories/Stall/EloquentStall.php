<?php

namespace App\Repositories\Stall;

use App\Models\Stall;

class EloquentStall implements StallRepository
{
	private $model;

	public function __construct(Stall $model)
	{
		$this->model = $model;
	}


	public function index()
	{
		return $this->model->all();
	}

	public function show($stall_id)
	{
		$this->model->findOrFail($stall_id);

		$stall = $this->model->with('icecreams')
					   ->where('id', $stall_id)
					   ->get();

		return $stall;
	}

	public function store($user, array $attributes)
	{
		$this->model->owner = $user->name;
		$stall = $this->model->fill($attributes);

		$stall->saveOrFail();
	}

	public function showOpinions($stall_id)
	{
		$this->model->findOrFail($stall_id);

		$stall = $this->model->with('opinions')
					   ->where('id', $stall_id)
					   ->get();

		return $stall;
	}

	public function destroy($stall_id)
	{
		$stall = $this->model->findOrFail($stall_id);

		$stall->delete($stall_id);
	}
}














?>
