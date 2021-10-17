<?php

namespace App\Http\Controllers;

use App\Http\Requests\StallStoreRequest;
use App\Repositories\Stall\StallRepository;

class StallController extends Controller
{

    private $stall;

    public function __construct(StallRepository $stall)
    {
        $this->stall = $stall;
    }

    public function index()
    {
        return $this->stall->index();
    }

    public function show($stall_id)
    {
        return $this->stall->show($stall_id);
    }

    public function showOpinions($stall_id)
    {
        return $this->stall->showOpinions($stall_id);
    }

    public function store(StallStoreRequest $request)
    {
        $user = auth()->user();

        return $this->stall->store($user, $request->all());
    }

    public function destroy($stall_id)
    {
        return $this->stall->destroy($stall_id);
    }




}






