<?php

namespace App\Repositories\Stall;

interface StallRepository
{
	public function index();

	public function show($stall_id);

	public function store($user, array $attributes, $upload);

	public function showOpinions($stall_id);

	public function showMyStalls($user);

	public function update($stall_id, array $attributes, $upload);

	public function destroy($stall_id);

	public function addToFavorite($user, $stall_id);

	public function removeFromFavorites($stall_id);

	public function showFavorites($user);

}

?>
