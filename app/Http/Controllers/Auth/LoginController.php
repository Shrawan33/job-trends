<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginMobileUser;
use App\Events\NewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ValidateRecaptcha;
use App\Traits\RedirectTo;
use Illuminate\Validation\ValidationException;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Str;

class LoginController extends Controller
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
    use RedirectTo;

    use ThrottlesLogins;

    protected $maxAttempts = 5;
    protected $decayMinutes = 5;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     Str::formatePhoneNumber($request);

    //     // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //     // the login attempts for this application. We'll key this by the username and
    //     // the IP address of the client making these requests into this application.
    //     if (method_exists($this, 'hasTooManyLoginAttempts') &&
    //         $this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }

    //     //otp based login for mobile user
    //     if (!empty($request->get('phone_number'))) {
    //         $user = User::wherePhoneNumber($request->phone_number)->first();

    //         if (empty($user)) {
    //             return redirect()->back()->withInput()->withErrors(['phone_number' => trans('message.no_user')]);
    //         }

    //         if ($user->isEmailVerified()) {
    //             event(new LoginMobileUser($user));

    //             return redirect()->route(
    //                 'front.register.verification.create',
    //                 Str::encryptVerificationData([
    //                     'userId' => $user->id,
    //                     'verification' => 'phone',
    //                     'otp' => 'yes'
    //                 ])
    //             );
    //         } else {
    //             event(new NewUser($user));

    //             return redirect()->route(
    //                 'front.register.verification.create',
    //                 Str::encryptVerificationData([
    //                     'userId' => $user->id,
    //                     'verification' => 'email'
    //                 ])
    //             );
    //         }
    //     }

    //     if ($this->attemptLogin($request)) {
    //         $user = Auth::user();

    //         if ($user->isVerified()) {
    //             Session::put('last_login', $user->last_login);
    //             DB::table('users')->where('id', $user->id)->update(array('last_login' => NOW()));
    //             return $this->sendLoginResponse($request);
    //         } else {
    //             Auth::logout();

    //             event(new NewUser($user));

    //             if ($user->isEmailVerified()) {
    //                 return redirect()->route(
    //                     'front.register.verification.create',
    //                     Str::encryptVerificationData([
    //                         'userId' => $user->id,
    //                         'verification' => 'phone'
    //                     ])
    //                 );
    //             } else {
    //                 return redirect()->route(
    //                     'front.register.verification.create',
    //                     Str::encryptVerificationData([
    //                         'userId' => $user->id,
    //                         'verification' => 'email'
    //                     ])
    //                 );
    //             }
    //         }
    //     }

    //     // If the login attempt was unsuccessful we will increment the number of attempts
    //     // to login and redirect the user back to the login form. Of course, when this
    //     // user surpasses their maximum number of attempts they will get locked out.
    //     $this->incrementLoginAttempts($request);

    //     return $this->sendFailedLoginResponse($request);
    // }


    public function login(Request $request)
{
    $this->validateLogin($request);

    Str::formatePhoneNumber($request);

    if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);
        return $this->sendLockoutResponse($request);
    }

    // Handle OTP based login for mobile users
    if (!empty($request->get('phone_number'))) {
        $user = User::wherePhoneNumber($request->phone_number)->first();

        if (empty($user)) {
            return redirect()->back()->withInput()->withErrors(['phone_number' => trans('message.no_user')]);
        }

        if ($user->isEmailVerified()) {
            event(new LoginMobileUser($user));
            return redirect()->route(
                'front.register.verification.create',
                Str::encryptVerificationData([
                    'userId' => $user->id,
                    'verification' => 'phone',
                    'otp' => 'yes'
                ])
            );
        } else {
            event(new NewUser($user));
            return redirect()->route(
                'front.register.verification.create',
                Str::encryptVerificationData([
                    'userId' => $user->id,
                    'verification' => 'email'
                ])
            );
        }
    }

    // Attempt user login
    if ($this->attemptLogin($request)) {
        $user = Auth::user();

        if ($user->isVerified()) {
            Session::put('last_login', $user->last_login);
            DB::table('users')->where('id', $user->id)->update(['last_login' => now()]);

            // Adjust the role check here as per the user's role
            if (!$user->hasRole(config('constants.front_login'))) {
                $this->guard()->logout();
                throw ValidationException::withMessages([
                    $this->username() => 'You do not have permission to log in.',
                ]);
            }

            return $this->sendLoginResponse($request);
        } else {
            Auth::logout();
            event(new NewUser($user));

            if ($user->isEmailVerified()) {
                return redirect()->route(
                    'front.register.verification.create',
                    Str::encryptVerificationData([
                        'userId' => $user->id,
                        'verification' => 'phone'
                    ])
                );
            } else {
                return redirect()->route(
                    'front.register.verification.create',
                    Str::encryptVerificationData([
                        'userId' => $user->id,
                        'verification' => 'email'
                    ])
                );
            }
        }
    }

    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
}


    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $rules = [
            'g-recaptcha-response' => [
                'required',
                new ValidateRecaptcha()
            ]
        ];

        if ($request->get('phone_number', null)) {
            $rules['phone_number'] = 'required';
        } else {
            $rules[$this->username()] = 'required|string';
            $rules['password'] = 'required|string';
        }

        return $request->validate(
            $rules,
            [
                'g-recaptcha-response.required' => trans('message.human_check')
            ]
        );
    }
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            $user = $this->guard()->user();

            if (!$user->hasRole(config('constants.front_login'))) {
                $this->guard()->logout();

                throw ValidationException::withMessages([
                    $this->username() => 'You do not have permission to log in.',
                ]);
            }

            return true;
        }

        return false;
    }
}
