<?php

namespace App\Repositories\Icecream;

interface IcecreamRepository
{
	public function index();

	public function show($id);

	public function store($user, $icecream_id, array $attributes);

	public function update($icecream_id, array $attributes);

	public function destroy($icecream_id);

	public function find($request);

}

?>
