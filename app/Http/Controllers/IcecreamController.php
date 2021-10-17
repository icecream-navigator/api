<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IcecreamStoreRequest;
use App\Repositories\Icecream\IcecreamRepository;

class IcecreamController extends Controller
{
    private $icecream;

    public function __construct(IcecreamRepository $icecream)
    {
        $this->icecream = $icecream;
    }

    public function store(IcecreamStoreRequest $request, $icecream_id)
    {
        $user = auth()->user();

        return $this->icecream->store($user, $icecream_id, $request->all());
    }

    public function update(Request $request, $icecream_id)
    {
        return $this->icecream->update($icecream_id, $request->all());

    }

    public function destroy($icecream_id)
    {
        $this->icecream->destroy($icecream_id);
    }
}
