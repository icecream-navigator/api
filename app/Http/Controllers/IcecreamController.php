<?php

namespace App\Http\Controllers;

use App\Http\Requests\IcecreamSearchRequest;
use App\Http\Requests\IcecreamStoreRequest;
use App\Http\Requests\IcecreamUpdateRequest;
use App\Repositories\Icecream\IcecreamRepository;

class IcecreamController extends Controller
{
    private $icecream;

    public function __construct(IcecreamRepository $icecream)
    {
        $this->icecream = $icecream;
    }

    public function index()
    {
        return $this->icecream->index();
    }

    public function show($icecream_id)
    {
        return $this->icecream->show($icecream_id);
    }

    public function store(IcecreamStoreRequest $request, $icecream_id)
    {
        $user = auth()->user();

        $this->icecream->store($user, $icecream_id, $request->all());

        return response()->json(['message'=>'Icecream stored']);
    }

    public function update(IcecreamUpdateRequest $request, $icecream_id)
    {
        $this->icecream->update($icecream_id, $request->all());

        return response()->json(['message'=>'Icecream updated']);

    }

    public function destroy($icecream_id)
    {
        $this->icecream->destroy($icecream_id);

        return response()->json(['message'=>'Icecream destroyed']);
    }

    public function search(IcecreamSearchRequest $request)
    {
        return $this->icecream->find($request->input('search'));

    }
}
