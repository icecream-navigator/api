<?php

namespace App\Http\Controllers;

use App\Http\Requests\StallStoreRequest;
use App\Repositories\Stall\StallRepository;
use Illuminate\Http\Request;

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

    public function showMyStalls()
    {
        $user = auth()->user();

        return $this->stall->showMyStalls($user);
    }

    public function store(StallStoreRequest $request)
    {
        $user = auth()->user();

        $upload = $this->stall->photo = $request->file('photo');

        $this->stall->store($user, $request->all(), $upload);

        return response()->json(['message'=>'Created new stall']);
    }

    public function update($stall_id, Request $request)
    {
        $upload = $this->stall->photo = $request->file('photo');

        $this->stall->update($stall_id, $request->all(), $upload);

        return response()->json(['message'=>'Updated stall']);
    }

    public function destroy($stall_id)
    {
        $this->stall->destroy($stall_id);

        return response()->json(['message'=>'Destroyed stall']);
    }




}






