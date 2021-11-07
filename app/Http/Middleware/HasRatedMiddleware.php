<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Rate;

class HasRatedMiddleware
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
        $id = $request->id;

        $hasRate = Rate::where([
            'user_id' => $user->id,
            'stall_id' => $id
        ])->exists();

        if($hasRate)
        {
            abort(403, 'You rated this stall before');
        }

        return $next($request);
    }
}
