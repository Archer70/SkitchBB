<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class LastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $user->last_seen = Carbon::now()->__toString();
            $user->save();
        }
        return $next($request);
    }
}
