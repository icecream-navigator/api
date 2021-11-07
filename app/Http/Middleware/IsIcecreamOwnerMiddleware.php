<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Icecream;

class IsIcecreamOwnerMiddleware
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
        $id = $request->route('icecream_id');

        $icecream = Icecream::findOrFail($id);

        if(auth()->user()->id === $icecream->user_id)
        {
            return $next($request);
        }
        else
        {
            abort(401);
        }

    }
}
