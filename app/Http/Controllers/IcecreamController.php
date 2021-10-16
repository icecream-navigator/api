<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icecream;
use App\Http\Requests\IcecreamStoreRequest;

class IcecreamController extends Controller
{

    public function show(Icecream $icecream, $id)
    {
        $icecream_with_opinions = $icecream->showIcecream($id);

        return response()
            ->json([
                'ICECREAM_WITH_OPINIONS'=> $icecream_with_opinions
            ]);
    }

    public function store(IcecreamStoreRequest $request, Icecream $icecream, $id)
    {
        $user = auth()->user();

        $icecream->storeIcecream($user, $request->all(), $id);

        return response()
            ->json(['MESSAGE'=>'A icecream has been added']);
    }

    public function update(Request $request, Icecream $icecream, $id)
    {
        $icecream->updateIcecream($id, $request->all());

        return response()
            ->json(['MESSAGE'=>'A icecream has been updated']);
    }

    public function destroy(Icecream $icecream, $id)
    {
        $icecream->destroyIcream($id);

        return response()
            ->json(['MESSAGE'=>'A icecream has been deleted']);
    }
}
