<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use ChristianKuri\LaravelFavorite\Models\Favorite;

class HasFavoriteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        $hasFavorite = Favorite::where('user_id', $user->id)->exists();

        if($hasFavorite)
        {
            abort(403, 'You already favorite this stall');
        }
        return $next($request);
    }
}
