<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeEmailPhoneRequest;
use App\Http\Requests\VerifyEmailPhoneRequest;
use App\Repositories\VerificationCodeRepository;
use App\Traits\ChangeEmailPhoneHelper;
use App\Traits\RedirectTo;
use Illuminate\Support\Str;


class ChangeEmailPhoneController extends Controller
{
    use RedirectTo, ChangeEmailPhoneHelper;
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
        return view('change_email_phone.index');
    }

    /**
     * Show the form for creating a new resource.
     * change email and contact number on edit profile
     *
     * @return \Illuminate\Http\Response
     */
    public function create(VerifyEmailPhoneRequest $request, VerificationCodeRepository $verificationCodeRepository, UserRepository $repository)
    {
        // dd($request);
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
                $user = $repository->find($userId);
                if ($requestInput->get('email')) {
                    $user->email = $requestInput->get('email');
                }
                if ($requestInput->get('phone_number')) {
                    $user->phone_number = $requestInput->get('phone_number');
                }

                $user->save();
                return redirect()->route('users.profile');
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
    public function store(ChangeEmailPhoneRequest $request)
    {
        try {
            //check is there any user already having phone and email.
            $isExist = $this->alreadyExistCredentials($request->get('email'), $request->get('phone_number'));
// dd()
            if (!empty($isExist)) {
                return redirect()->back()->withInput()->withErrors([
                    $this->getField() => 'These email or phone already in use by someone else.'
                ]);
            }

            if ($request->get('email') != null) {
                $this->setEmail(auth()->user()->email);
            } else {
                $this->setEmail($request->get('email'));
            }
            if ($request->get('phone_number') != null) {
                $this->setPhoneNumber(Str::formatePhoneNumber(auth()->user()->phone_number));
            } else {
                $this->setPhoneNumber(Str::formatePhoneNumber($request->get('phone_number')));
            }
            $user = $this->getUser();

            $is_email_change_request = false;
            if ($request->get('email') != null) {
                $user->email = $request->get('email');
                $is_email_change_request = true;
            }
            if ($request->get('phone_number') != null) {
                $user->phone_number = Str::formatePhoneNumber($request->get('phone_number'));
                $is_email_change_request = false;
            }

            if (empty($user)) {
                return redirect()->back()->withInput()->withErrors([
                    $this->getField() => 'User does not exist.'
                ]);
            }

            $this->generateEvent($user, $is_email_change_request);

            $requestData = array_merge(
                [
                    'userId' => $user->id,
                    'changeEmailPhone' => 'yes',
                    'email' => $user->email,
                    'phone_number' => $user->phone_number
                ],
                $this->getExtraRequestData()
            );

            return redirect()->route(
                'front.register.verification.create',
                Str::encryptVerificationData($requestData)
            );
        } catch (\Throwable $th) {
            throw $th;
        }

        return back()->withInput();
    }
}
