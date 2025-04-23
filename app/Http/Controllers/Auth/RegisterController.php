<?php
namespace App\Http\Controllers\Auth;

use App\Events\UserContactVerified;
use App\Events\NewUser;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\VerifyEmailPhoneRequest;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SuccessfulRegistration;
use App\Providers\RouteServiceProvider;
use App\Repositories\DocumentRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\PackageRepository;
use App\Repositories\UserPackageRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Repositories\VerificationCodeRepository;
use App\Traits\RedirectTo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Utils\ResponseUtil;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;
use Throwable;

class RegisterController extends AppBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use RedirectTo;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public $repository;
    public $userProfileRepository;
    public $jobseekerProfileRepository;
    public $userPackageRepository;
    public $packageRepository;
    private $disk = 'user';
    public $documentRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, UserProfileRepository $userProfileRepo, JobSeekerDetailRepository $jobseekerProfileRepo, UserPackageRepository $userPackageRepo, PackageRepository $packageRepo, DocumentRepository $documentRepo)
    {
        $this->middleware('guest');
        $this->repository = $userRepository;
        $this->userProfileRepository = $userProfileRepo;
        $this->jobseekerProfileRepository = $jobseekerProfileRepo;
        $this->userPackageRepository = $userPackageRepo;
        $this->packageRepository = $packageRepo;

        $this->getEntity(null, $this->disk);
        $this->documentRepository = $documentRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    protected function create($type = 'employer')
    {
        return view('auth.register', compact('type'));
    }

    protected function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = config('constants.user_role.' . $request->user_type);
            $input = $request->all();
            $input = Str::formatePhoneNumber($input);
            $field = $role == 'jobseeker' ? 'jobseeker_number' : 'employer_number';
            $model = $this->repository->makeModel();
            $input['user_code'] = \Illuminate\Support\Str::getNextNumber($field, $model->getCounter(), null);
            $requiredVerification = 'email';
            if ($request->get('provider', null) != null) {
                $input['email_verified_at'] = FunctionHelper::today(false, true, true);
                $requiredVerification = '';
            } else {
                $input['password'] = Hash::make($request->password);
            }
            // dd($input);
            $user = $this->repository->create($input);

            // assign role
            if (!empty($role)) {
                $user->assignRole($role);
                // dd($user->id);
                //assign default package to employer
                if ($role == 'employer') {
                    $package = $this->packageRepository->all(['is_default' => 1])->first();
                    if ($package) {
                        $data = ['user_id' => $user->id, 'package_id' => $package->id, 'package_info' => $package->toArray()];
                        $this->userPackageRepository->subscribe($data, true);
                    }
                }
            }

            if($role == 'jobseeker')
            {
                $input_data['primary_account'] = 1;
                $input_data['user_id'] = $user->id ?? '';
                $input_data['first_name'] = $user->first_name ?? '';
                $input_data['last_name'] = $user->last_name ?? '';
                $input_data['email'] = $user->email ?? '';
                $input_data['phone'] = $user->phone_number ?? '';
                $seekerDetail = $this->jobseekerProfileRepository->sync($input_data, $user);
            }

            event(new NewUser($user));

            DB::commit();
            if ($request->get('provider', null) != null) {
                Auth::login($user);
                return redirect()->route('users.profile');
            } else {
                return redirect()->route(
                    'front.register.verification.create',
                    Str::encryptVerificationData([
                        'userId' => $user->id,
                        'verification' => $requiredVerification
                    ])
                );
            }

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return redirect()->back()->withInput();
    }

    protected function createVerify(Request $request, $token)
    {
        $requestInput = collect(Str::decryptVerificationData($token));

        $userId = $requestInput->get('userId', 0);
        $verification = $requestInput->get('verification');
        $otp = $requestInput->get('otp', null);
        $route = '';

        if ($requestInput->get('passwordReset')) {
            $route = route('forgot_password.verify');
        }

        $user = $this->repository->find($userId);

        if (!empty($user)) {
            switch ($verification) {
                case 'email':
                    return view('auth.verification.email', compact('user', 'verification', 'route', 'token'));
                    break;

                case 'phone':
                    return view('auth.verification.phone', compact('user', 'verification', 'otp', 'route', 'token'));
                    break;
            }
        }

        return redirect()->back();
    }

    protected function verify(VerifyEmailPhoneRequest $request, VerificationCodeRepository $verificationCodeRepository)
    {
        $error = trans('message.default_error');

        try {
            $requestInput = collect(Str::decryptVerificationData($request->get('token')));

            $userId = $requestInput->get('userId');
            $verificationCode = $request->get('verification_code');
            $verification = $requestInput->get('verification');

            $verificationData = $verificationCodeRepository->getUserVerificationData($userId);

            if (!empty($verificationData) && $verificationData->isVerificationCodeCorrect($verificationCode, $verification)) {
                $verificationCodeRepository->makeUserDataVerified($userId, $verification);

                event(new UserContactVerified($userId, $verification));

                $verificationData = $verificationData->refresh();

                if ($verificationData->verificationDone()) {
                    $user = User::findOrFail($userId);
                    // notify to register user
                    $user->notify(new SuccessfulRegistration($user));

                    Auth::login($user);
                    Session::put('last_login', $user->last_login);
                    DB::table('users')->where('id', $user->id)->update(array('last_login' => NOW()));

                    // $intendedUrl = Session::get('url.intended', '')->getName();
                    // dd($intendedUrl);

                    //dd($this->redirectTo());
                    return redirect()->intended($this->redirectTo());
                } else {
                    return redirect()->route(
                        'front.register.verification.create',
                        Str::encryptVerificationData([
                            'userId' => $userId,
                            'verification' => ($verification == 'email' ? 'phone' : 'email')
                        ])
                    );
                }
            } else {
                $error = trans('message.invalid_code');
            }
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return redirect()->back()->withErrors(['verification_code' => $error]);
    }

    public function guestRegister()
    {
        return view('auth.guest_register', ['entity' => $this->entity]);
    }

    protected function storeGuestUser(CreateOfferUserRequest $request)
    {
        try {

            DB::beginTransaction();
            $role = 'jobseeker';
            $input = $request->all();
            // dd($input);
            $input = Str::formatePhoneNumber($input);
            $field = $role == 'jobseeker' ? 'jobseeker_number' : 'employer_number';
            $model = $this->repository->makeModel();
            $input['user_code'] = \Illuminate\Support\Str::getNextNumber($field, $model->getCounter(), null);
            $requiredVerification = 'email';
            $input['password'] = Hash::make($request->password);
            // dd($input);
            $user = $this->repository->create($input);

            // assign role
            if (!empty($role)) {
                $user->assignRole($role);
                // if ($role == 'employer') {
                //     $package = $this->packageRepository->all(['is_default' => 1])->first();
                //     if ($package) {
                //         $data = ['user_id' => $user->id, 'package_id' => $package->id, 'package_info' => $package->toArray()];
                //         $this->userPackageRepository->subscribe($data, true);
                //     }
                // }
            }

            if($role == 'jobseeker')
            {
                $input_data['primary_account'] = 1;
                $input_data['first_name'] = $user->first_name ?? '';
                $input_data['last_name'] = $user->last_name ?? '';
                $input_data['email'] = $user->email ?? '';
                $input_data['phone'] = $user->phone_number ?? '';
                $input_data['instruction_cv_writing'] = $input['instruction_cv_writing'] ?? '';
                $input_data['linkedin_link'] = $input['linkedin_link'] ?? '';
                $input_data['user_id'] = $user->id ?? '';
                $seekerDetail = $this->jobseekerProfileRepository->sync($input_data, $user);
            }

            // resume upload
            if ($seekerDetail->exists()) {
                $document = $request->get('document', []);
                $doc_type = config('constants.document_type.document', 1);
                $this->documentRepository->savePermanent($document, $doc_type, $seekerDetail);
            }

            event(new NewUser($user));

            DB::commit();
            if ($request->get('provider', null) != null) {
                Auth::login($user);
                return redirect()->route('users.profile');
            } else {

                $package = $this->packageRepository->all(['role_type' => 'jobseekers', 'package_type' => 6, 'is_addon' => 0])->first();
                Redirect::setIntendedUrl(route('add-item-to-cart', $package->id));
                return redirect()->route(
                    'front.register.verification.create',
                    Str::encryptVerificationData([
                        'userId' => $user->id,
                        'verification' => $requiredVerification
                    ])
                );
            }

        } catch (Throwable $th) { dd($th);
            DB::rollback();
            throw $th;
        }

        return redirect()->back()->withInput();
    }

    public function offerThank() {
        return view('auth.offer_thank');
    }
}
