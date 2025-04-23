<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class ToRolePage
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
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        Role::cacheRoles();

        $user = auth()->user();
        if ($user->hasRole('employer')) {
            return $next($request) ?? redirect()->route('employer.index');
        } elseif ($user->hasRole('jobseeker')) {
            return $next($request) ?? redirect()->route('jobseeker.index');
        }

        return redirect()->route('home');
    }
}
