<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {


        if (!Auth::guard($guard)->check()) {
            Session::put('url.intended', url()->current());
            return redirect()->route('login');
        }
        $response = $next($request);
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
    }
}
