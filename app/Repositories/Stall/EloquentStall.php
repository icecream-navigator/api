<?php

namespace App\Repositories\Stall;

use App\Models\Stall;
use App\Services\UploadPhotoService;

class EloquentStall implements StallRepository
{
	private $model, $upload;

	public function __construct(Stall $model, UploadPhotoService $upload)
	{
		$this->model  = $model;
		$this->upload = $upload;
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

	public function store($user, array $attributes, $upload)
	{
		$this->upload->setImage($upload);

		$this->model->user_id    = $user->id;
		$this->model->owner      = $user->name;
		$this->model->photo_url  = $this->upload->getPhotoUrl();
		$this->model->photo_name = $this->upload->getPhotoName();

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

	public function showMyStalls($user)
	{
		$stalls = $user->stalls()->get();

		return $stalls;
	}

	public function update($stall_id, array $attributes, $upload)
	{
		$stall = $this->model->findOrFail($stall_id);

		$this->upload->setImage($upload);

		$stall->photo_url  = $this->upload->getPhotoUrl();
		$stall->photo_name = $this->upload->getPhotoName();

		$stall->update($attributes);
	}

	public function destroy($stall_id)
	{
		$stall = $this->model->findOrFail($stall_id);

		$stall->delete($stall_id);
	}

	public function addToFavorite($user, $stall_id)
	{
		$stall = $this->model->findOrFail($stall_id);

		$user->addFavorite($stall);

	}

	public function removeFromFavorites($stall_id)
	{
		$stall = $this->model->findOrFail($stall_id);

		$stall->removeFavorite();
	}

	public function showFavorites($user)
	{
		$stall = $user->favorite(Stall::class);

		return $stall;

	}
}


?>
