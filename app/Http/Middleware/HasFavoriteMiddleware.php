<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Stall;

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
        $id   = $request->route('stall_id');

        $stall = Stall::find($id);

        $hasFavorite = $stall->isFavorited();

        if($hasFavorite)
        {
            abort(403, 'You favorite this stall before');
        }

        return $next($request);
    }
}
