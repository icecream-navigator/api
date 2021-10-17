<?php

namespace App\Repositories\Stall;

interface StallRepository
{
	public function index();

	public function show($stall_id);

	public function store($user, array $attributes);

	public function showOpinions($stall_id);

	public function destroy($stall_id);
}

?>
