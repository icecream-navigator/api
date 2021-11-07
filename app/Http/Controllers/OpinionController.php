<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpinionStoreRequest;
use App\Repositories\Opinion\OpinionRepository;

class OpinionController extends Controller
{
    private $opinion;

    public function __construct(OpinionRepository $opinion)
    {
        $this->opinion = $opinion;
    }

    public function store(OpinionStoreRequest $request, $stall_id)
    {
        $user = auth()->user();

        $this->opinion->store($user, $stall_id, $request->all());

        return response()->json(['message'=>'Opinion created']);

    }
}
