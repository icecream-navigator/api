<?php

namespace App\Repositories\Rate;

interface RateRepository
{
	public function store($user, $stall_id, $rate);

	//public function calculateRate($rate_id);
}


?>
