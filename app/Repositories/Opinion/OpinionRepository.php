<?php

namespace App\Repositories\Opinion;

interface OpinionRepository
{
	public function store($user, $stall_id, array $attributes);
}

?>
