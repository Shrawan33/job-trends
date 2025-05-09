<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class IsStaff
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
        if (Auth::user()) {
            return $next($request);
        }

        Flash::error('Use staff user credentials only.');
        return redirect()->route('staff.login');
    }
}
