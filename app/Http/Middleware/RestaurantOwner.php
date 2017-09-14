<?php

namespace App\Http\Middleware;

use Closure;

class RestaurantOwner
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
        if (!auth()->user()->isOwnerOfRestaurant(auth()->user()->currentRestaurant)) {
            return back();
        }

        return $next($request);
    }
}
