<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Stall;

class IsStallOwnerMiddleware
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
        $id = $request->route('stall_id');

        $stall = Stall::findOrFail($id);

        if(auth()->user()->id === $stall->user_id)
        {
            return $next($request);
        }
        else
        {
            abort(401);
        }
    }
}
