<?php

namespace App\Repositories\Icecream;

use App\Models\Icecream;
use App\Models\Stall;

class EloquentIcecream implements IcecreamRepository
{
	private $model;

	public function __construct(Icecream $model)
	{
		$this->model = $model;
	}

	public function index()
	{
		return $this->model->all();
	}

	public function show($icecream_id)
	{
		$icecream = $this->model->findOrFail($icecream_id);

		$icecream->loadCount('votes');

		return $icecream;

	}

	public function store($user,$stall_id, array $attributes)
	{
		$stall = Stall::findOrFail($stall_id);

		$this->model->user_id        = $user->id;
		$this->model->stall_id       = $stall_id;
		$this->model->stall_location = $stall->town;

		$this->model->fill($attributes);

		$this->model->saveOrFail();

	}

	public function update($icecream_id, array $attributes)
	{
		$icecream = $this->model->findOrFail($icecream_id);

		$icecream->update($attributes);
	}

	public function destroy($icecream_id)
	{
		$icecream = $this->model->findOrFail($icecream_id);

		$icecream->delete($icecream_id);
	}

	public function find($request)
	{
		//$result = $this->model->search($request)->get();
		$result = $this->model->search('"indyk"brzoskwinia')->get();

		return $result;
	}
}




















?>
