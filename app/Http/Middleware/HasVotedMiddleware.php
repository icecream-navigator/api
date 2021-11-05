<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vote;

class HasVotedMiddleware
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


        $hasVote = Vote::where([
            'user_id'     => $user->id,
            'icecream_id' => $id
        ])->exists();

        if($hasVote)
        {
            abort(403, 'You already voted this icecream');
        }

        return $next($request);
    }
}
