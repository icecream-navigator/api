<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use App\Http\Requests\OpinionStoreRequest;

class OpinionController extends Controller
{

    public function store (Opinion $opinion, OpinionStoreRequest $request ,$id)
    {
        $user = auth()->user();

        $opinions = $opinion->storeOpinion($user, $request->all(),$id);

        return response()
            ->json([
                'STALLS_WITH_OPINIONS'=>$opinions
            ], 200, [], JSON_UNESCAPED_SLASHES);
    }
}
