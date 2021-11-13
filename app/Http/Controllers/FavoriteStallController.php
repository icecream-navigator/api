<?php

namespace App\Http\Controllers;

use App\Repositories\Stall\StallRepository;

class FavoriteStallController extends Controller

{
    private $stall;

    public function __construct(StallRepository $stall)
    {
        $this->stall = $stall;
    }

    public function index()
    {
        $user = auth()->user();

        return response($this->stall->showFavorites($user));
    }

    public function favourite($stall_id)
    {
        $user = auth()->user();

        $this->stall->addToFavorite($user, $stall_id);
    }

    public function unfavourite($stall_id)
    {
        $this->stall->removeFromFavorites($stall_id);
    }

    public function favoriteCounter()
    {
        $user = auth()->user();

        return response($this->stall->favoriteCounter($user));
    }

}
