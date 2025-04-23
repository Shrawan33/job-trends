<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StaffLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin';
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            $user = $this->guard()->user();

            if (!$user->hasRole(config('constants.staff_login'))) {
                $this->guard()->logout();

                throw ValidationException::withMessages([
                    $this->username() => 'You do not have permission to log in.',
                ]);
            }

            return true;
        }

        return false;
    }
    protected function redirectTo()
    {
        // dd(auth()->user()->hasRole('admin'));
        if (auth()->user()->hasRole('admin')) {
            return route('dashboard.index');
        } elseif (auth()->user()->hasRole('mentor')) {
            return route('job-posting-mentor.index');
        } elseif (auth()->user()->hasRole('account')) {
            return route('account-dashboard.index');
        }
        // return redirect()->route('mentor_candidates.index');
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->redirectTo = ;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('staff.auth.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('staff.login');
    }
}
