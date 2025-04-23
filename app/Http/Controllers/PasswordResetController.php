<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyEmailPhoneRequest;
use App\Repositories\VerificationCodeRepository;
use App\Traits\PasswordResetHelper;
use App\Traits\RedirectTo;
use App\Traits\UserTokenHelper;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    use RedirectTo, PasswordResetHelper, UserTokenHelper;

    private $email;
    private $phoneNumber;

    public function __construct($email = null, $phoneNumber = null)
    {
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forgot_password.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(VerifyEmailPhoneRequest $request, VerificationCodeRepository $verificationCodeRepository)
    {
        $error = 'Something went wrong. Please try again.';

        try {
            $requestInput = collect(Str::decryptVerificationData($request->get('token')));

            $userId = $requestInput->get('userId');
            $verificationCode = $request->get('verification_code');
            $verification = $requestInput->get('verification');

            $verificationData = $verificationCodeRepository->getUserVerificationData($userId);

            if (
                !empty($verificationData)
                &&
                $verificationData->isVerificationCodeCorrect($verificationCode, $verification)
            ) {
                $token = $this->createUserToken($userId);

                return redirect()->route('forgot_password.edit', $token);
            } else {
                $error = 'Entered code is incorrect. Please enter valid verification code.';
            }
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return back()->withErrors(['verification_code' => $error]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForgotPasswordRequest $request)
    {
        try {
            $this->setPhoneNumber(Str::formatePhoneNumber($request->get('phone_number')));
            $this->setEmail($request->get('email'));

            $user = $this->getUser();

            if (empty($user)) {
                return redirect()->back()->withInput()->withErrors([
                    $this->getField() => 'User does not exist.'
                ]);
            }

            $this->generateEvent($user);

            $requestData = array_merge(
                [
                    'userId' => $user->id,
                    'passwordReset' => 'yes'
                ],
                $this->getExtraRequestData()
            );

            return redirect()->route(
                'front.register.verification.create',
                Str::encryptVerificationData($requestData)
            );
        } catch (\Throwable $th) {
            //throw $th;
        }

        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        try {
            $user = $this->getUserFromToken($token);

            if (empty($user)) {
                return redirect()->route('login')->withErrors(['email' => 'User does not exist.']);
            }

            if ($this->isTokenExpired($token)) {
                $this->clearUserTokens($user->id);

                return redirect()->route('login')->withErrors(['email' => 'Token has expired.']);
            }

            return view('forgot_password.edit', compact('token'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->route('login')->withErrors(['email' => 'Something went wrong. Please try again.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function update(ResetPasswordRequest $request)
{
    try {
        $user = $this->getUserFromToken($request->get('token'));

        if (empty($user)) {
            return redirect()->route('login')->withErrors(['email' => 'User does not exist.']);
        }

        if ($this->isTokenExpired($request->get('token'))) {
            $this->clearUserTokens($user->id);

            return redirect()->route('login')->withErrors(['email' => 'Token has expired.']);
        }

        $this->setUserPassword($user, $request->get('password'));
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        $this->clearUserTokens($user->id);

        return redirect()->route('login')->with('success', 'Your Password has been Reset Successfully. Please log in with your New Password.');
    } catch (\Throwable $th) {
        // Handle the exception if needed
    }

    return back();
}


}
