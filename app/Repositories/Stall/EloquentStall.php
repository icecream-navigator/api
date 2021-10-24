<?php

namespace App\Repositories\Stall;

use App\Models\Stall;
use Illuminate\Support\Facades\Storage;

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
		$img_url = Storage::disk('public')->url('default.png');

		$this->model->owner = $user->name;
		$this->model->stall_image = $img_url;
		$stall = $this->model->fill($attributes);

		$stall->saveOrFail();
	}

	public function showOpinions($stall_id)
	{
		$this->model->findOrFail($stall_id);

		$stall = $this->model->with('opinions')
					   ->where('id', $stall_id)
					   ->get();

		return response()
			->json(['Opinions' => $stall], 200, [], JSON_UNESCAPED_SLASHES);
	}

	public function destroy($stall_id)
	{
		$stall = $this->model->findOrFail($stall_id);

		$stall->delete($stall_id);
	}
}














?>
