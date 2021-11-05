<?php

namespace App\Http\Controllers;

use App\Repositories\Vote\VoteRepository;

class VoteController extends Controller
{
    private $vote;

    public function __construct(VoteRepository $vote)
    {
        $this->vote = $vote;
    }

    public function store($icecream_id)
    {
        $user = auth()->user();

        $this->vote->store($user, $icecream_id);

        return response()->json(['You voted']);

    }
}
