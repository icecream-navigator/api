<?php

namespace App\Http\Controllers;

use App\Http\Requests\StallStoreRequest;
use App\Models\Stall;

class StallController extends Controller
{

    public function index()
    {
        $stalls = Stall::all();

        return response()->json(['ALL_STALLS'=>$stalls]);
    }

    public function show(Stall $stall, $id)
    {
        $stalls_with_icecreams = $stall->showStall($id);

        return response()
            ->json(['STALLS_WITH_ICECREAMS'=>$stalls_with_icecreams]);
    }

    public function showStallWithOpinions(Stall $stall, $id)
    {
        $stalls_with_opinions = $stall->showOpinions($id);

        return response()
            ->json([
                'STALLS_WITH_OPINIONS'=>$stalls_with_opinions
            ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function store(Stall $stall, StallStoreRequest $request)
    {
        $user = auth()->user();

        $stall->storeStall($user, $request->all());

        return response()->json(['MESSAGE'=>'Stall has been added']);
    }

    public function destroy(Stall $stall, $id)
    {
        $stall->destroyStall($id);

        return response()->json(['MESSAGE'=> 'Stall has been deleted']);
    }
}






