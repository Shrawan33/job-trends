<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ChangeUserPasswordRequest;
use App\Http\Requests\CreateUserProfileRequest;
use App\Http\Requests\JobseekerExperienceRequest;
use App\Http\Requests\UpdateJobSeekerDetailRequest;
use App\Models\Configuration;
use App\Models\Event;
use App\Notifications\AccountRemove;
use App\Notifications\PasswordChange;
use App\Repositories\DocumentRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\UserRepository;
use App\Repositories\JobSeekerEducationRepository;
use App\Repositories\JobSeekerExperienceRepository;
use App\Repositories\JobSeekerLicenseRepository;
use App\Repositories\jobSeekerLanguageSkillRepository;
use App\Repositories\JobSeekerSkillRepository;
use App\Repositories\JobSeekerVideoRepository;
use App\Repositories\JobSeekerWorkTypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\UserProfileRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\UnauthorizedException;
use Laracasts\Flash\Flash;
use Throwable;
use App\Repositories\BadgeRepository;
use App\Repositories\PackageRepository;
use App\Repositories\UserReviewRepository;
use Razorpay\Api\Api;

class FrontUserController extends AppBaseController
{
    /** @var $repository repository */
    public $repository;
    public $userProfileRepository;

    public $jobseekerDetailRepository;
    public $jobSeekerEducationRepository;
    public $jobSeekerExperienceRepository;
    public $jobSeekerLicenseRepository;
    public $jobSeekerSkillRepository;
    public $jobSeekerVideoRepository;
    public $jobSeekerLanguageSkillRepository;
    public $documentRepository;
    public $jobSeekerWorkTypeRepository;
    public $eventRepository;
    private $disk = 'user';
    public $badgeRepository;
    public $userReviewRepository;
    public $packageRepository;

    public function __construct(UserRepository $userRepo, JobSeekerDetailRepository $jobseekerDetailRepo, JobSeekerEducationRepository $jobSeekerEducationRepo, JobSeekerExperienceRepository $jobSeekerExperienceRepo, JobSeekerLicenseRepository $jobSeekerLicenseRepo, JobSeekerSkillRepository $jobSeekerSkillRepo, JobSeekerVideoRepository $jobSeekerVideoRepo, DocumentRepository $documentRepo, UserProfileRepository $userProfileRepo, JobSeekerWorkTypeRepository $jobSeekerWorkTypeRepo, BadgeRepository $BadgeRepo, UserReviewRepository $UserReviewRepo,jobSeekerLanguageSkillRepository $jobSeekerLanguageSkillRepo, PackageRepository $packageRepo , EventRepository $eventRepo)
    {
        $this->repository = $userRepo;

        // employer
        $this->userProfileRepository = $userProfileRepo;

        // jobseeker
        $this->jobseekerDetailRepository = $jobseekerDetailRepo;
        $this->jobSeekerEducationRepository = $jobSeekerEducationRepo;
        $this->jobSeekerExperienceRepository = $jobSeekerExperienceRepo;
        $this->jobSeekerLicenseRepository = $jobSeekerLicenseRepo;
        $this->jobSeekerSkillRepository = $jobSeekerSkillRepo;
        $this->jobSeekerVideoRepository = $jobSeekerVideoRepo;
        $this->jobSeekerWorkTypeRepository = $jobSeekerWorkTypeRepo;
        $this->jobSeekerLanguageSkillRepository = $jobSeekerLanguageSkillRepo;
        $this->eventRepository = $eventRepo;

        $this->getEntity(null, $this->disk);
        $this->documentRepository = $documentRepo;
        $this->documentRepository->setDisk($this->disk);
        $this->badgeRepository = $BadgeRepo;
        $this->userReviewRepository = $UserReviewRepo;
        $this->packageRepository = $packageRepo;
    }

    public function profile()
    {
        try {
            $user = Auth::user();
            // $role = $user->roles->first()->name;
            if ($user->hasRole('employer')) {
                $view = 'auth.employer.profile.show';
            } elseif ($user->hasRole('jobseeker')) {
                $view = 'auth.job_seeker.profile.show';
            }
            else{
                return redirect()->route('login');
            }
            return view($view, compact('user'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function editProfile($mainTitle)
    {
        try {
            $user = Auth::user();
            // $role = $user->roles->first()->name;
            if ($user->hasRole('employer')) {
                $view = 'auth.employer.profile.edit';
                $imageModel = $this->userProfileRepository->makeModel();
                $userProfile = $user->usersProfile;
            } elseif ($user->hasRole('jobseeker')) {
                $view = 'auth.job_seeker.profile.edit';
                $imageModel = $this->jobseekerDetailRepository->makeModel();
                $userProfile = $user->seekerDetail;
            }
            return view($view, ['user' => $user, 'main_title' => $mainTitle ?? '', 'imageModel' => $userProfile ?? $imageModel, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function updateProfile(CreateUserProfileRequest $request)
    {
        $user_id = $request->get('user_id', 0);
        $user = $this->repository->find($user_id, ['*'], true);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            // update user info [first_name, last_name, email, phone]
            $this->repository->update($request->all(), $user_id, true);

            // create/update user profile
            $userProfile = $this->userProfileRepository->sync($request->all(), $user);

            if ($userProfile->exists()) {
                // logo
                $logo = $request->get('employer_logo', []);
                $doc_type = config('constants.document_type.image', 0);
                $this->documentRepository->savePermanent($logo, $doc_type, $userProfile);

                // images
                $images = $request->get('employer_images', []);
                $doc_type = config('constants.document_type.cropped_images', 2);

                $this->documentRepository->savePermanent($images, $doc_type, $userProfile);
            }
            // $input = ['toast_success' => "Profile updated successfully."];
            Flash::success('Profile updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateProfileSeeker(UpdateJobSeekerDetailRequest $request)
    {
        // dd($request->all());
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            $input = $request->all();
            // dd($input);
            //update user info [first_name, last_name, email, phone]
            //update intro section
            $user = $this->repository->update($request->all(), $user_id, true);
            $seekerExperience = [
                'exp_id' => $request->exp_id ?? null,
                'company' => $request->company ?? null,
                'role' => $request->role ?? null,
                'location' => $request->location ?? null,
                'from_month' => $request->from_month ?? null,
                'duration_from' => $request->duration_from ?? null,
                'to_month' => $request->to_month ?? null,
                'duration_to' => $request->duration_to ?? null,
                'reference_name' => $request->reference_name ?? null,
                'reference_phone_number' => $request->reference_phone_number ?? null,
                'reference_position' => $request->reference_position ?? null,
                'years_known' => $request->years_known ?? null,
                'description' => $request->description ?? null,
                'currently_working' => $request->currently_working ?? null,
            ];

            $seekerEducation = [
                'edu_id' => $request->edu_id ?? null,
                'qualification_id' => $request->qualification_id ?? null,
                'specialization_id' => $request->specialization_id ?? null,
                'university' => $request->university ?? null,
                'percentile_cgpa' => $request->percentile_cgpa ?? null,
                'education_from_month' => $request->education_from_month ?? null,
                'education_duration_from' => $request->education_duration_from ?? null,
                'education_to_month' => $request->education_to_month ?? null,
                'education_duration_to' => $request->education_duration_to ?? null
            ];
            $seekerLicense = [
                'user_id' => $request->user_id ?? null,
                'certificate_name' => $request->certificate_name ?? null,
                'certifying_authority' => $request->certifying_authority ?? null,
                'from_month' => $request->from_month ?? null,
                'from_year' => $request->from_year ?? null,
                // 'to_month' => $request->to_month ?? null,
                // 'to_year' => $request->to_year ?? null,
                // 'seeker_detail_id' => $request->seeker_detail_id ?? null,
            ];
            $seekerLanguageSkill = [
                'user_id' => $request->user_id ?? null,
                'language_id' => $request->language_id ?? null,
                'speak_id' => $request->speak_id ?? null,
                'read_write_id' => $request->read_write_id ?? null,
            ];

            // dd($seekerSkill);
            $ii = $request->except('exp_id', 'description', 'company', 'role', 'location', 'from_month', 'education_from_month', 'duration_from', 'education_duration_from', 'to_month', 'education_to_month', 'duration_to', 'education_duration_to', 'reference_name', 'reference_phone_number', 'reference_position', 'years_known', 'qualification_id', 'specialization_id', 'university', 'percentile_cgpa', 'education_from_month','education_duration_from','education_to_month','education_duration_to','certificate_name','certifying_authority','from_month','from_year','to_month','to_year','seeker_detail_id','language_id','speak_id','read_write_id','skill_id', 'currently_working');
            //dd($ii);
            $seekerDetail = $this->jobseekerDetailRepository->sync($ii, $user);
            $seekerSkill = [
                'user_id' => $request->user_id ?? null,
                'skill_id' => $request->skill_id ?? null
            ];
            // $relocationValue = $request->has('Relocation') ? 1 : 0;
            $relocationValue = $request->get('Relocation', null) != null ? 1 : 0;
            // $seekerDetail->year = json_encode($request->input('year'));

            $is_fresherValue = $request->get('is_fresher', null) != null ? 1 : 0;
            $seekerDetail['is_fresher'] = $is_fresherValue;

            $seekerDetail['Relocation'] = $relocationValue;
            $seekerDetail->save();


            //assign work_type_id to jobseeker
            $workTypes = isset($input['work_type_id']) ? $input['work_type_id'] : [];
            // dd($workTypes, $seekerDetail);
            $this->jobSeekerWorkTypeRepository->syncByWorkType($workTypes, $seekerDetail);

            if ($seekerDetail->exists()) {
                // logo
                $logo = $request->get('jobseeker_logo', []);
                $doc_type = config('constants.document_type.image', 0);

                $this->documentRepository->savePermanent($logo, $doc_type, $seekerDetail);

                 // banner
                 $banner = $request->get('jobseeker_banner', []);
                 $doc_type = config('constants.document_type.cropped_images', 2);
                 $this->documentRepository->savePermanent($banner, $doc_type, $seekerDetail);

                // resume upload
                $document = $request->get('document', []);
                $doc_type = config('constants.document_type.document', 1);
                $this->documentRepository->savePermanent($document, $doc_type, $seekerDetail);

                 // Cover document upload
                 $cover_document = $request->get('cover_letter', []);
                 $doc_type = config('constants.document_type.cover_letter', 5);
                 $this->documentRepository->savePermanent($cover_document, $doc_type, $seekerDetail);
            }


            // dd($seekerExperience);
// dd($seekerDetail->id);
            // dd($seekerSkill, $user_id, $seekerDetail->id);
            $this->jobSeekerExperienceRepository->syncExperience($seekerExperience, $user_id, $seekerDetail->id);
            $this->jobSeekerEducationRepository->syncEducation($seekerEducation, $user_id, $seekerDetail->id);
            $this->jobSeekerLicenseRepository->syncLicense($seekerLicense, $user_id, $seekerDetail->id);
            $this->jobSeekerLanguageSkillRepository->synclanguageSkill($seekerLanguageSkill, $user_id, $seekerDetail->id);
            $this->jobSeekerSkillRepository->syncSkill($seekerSkill, $user_id, $seekerDetail->id);
           // $this->jobSeekerSkillRepository->syncSkill($request->all(), Auth::id(), $seekerDetail->id);


            $input = ['toast_success' => "Profile updated successfully."];
            // Flash::success('Profile updated successfully.');
            return redirect()->route('users.profile')->withInput($input);
        } catch (Throwable $e) { dd($e);
            throw $e;
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateSeekerExperience(JobseekerExperienceRequest $request)
    {
        // dd($request->all());
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);
        $seeker_detail = $this->jobseekerDetailRepository->all(['user_id' => $user_id, 'primary_account' => 1])->first();
        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            //update experience section
            $seekerDetail = $this->jobseekerDetailRepository->sync($request->only('total_experience', 0), $user, $seeker_detail->id);
            $this->jobSeekerExperienceRepository->syncExperience($request->all(), $user_id, $seeker_detail->id);

            Flash::success('Experience updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateSeekerEducation(Request $request)
    {
        // dd($request->all());
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);
        $seeker_detail = $this->jobseekerDetailRepository->all(['user_id' => $user_id, 'primary_account' => 1])->first();

        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            //update education section
            $this->jobSeekerEducationRepository->syncEducation($request->all(), $user_id, $seeker_detail->id);
            Flash::success('Education updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateSeekerLicense(Request $request)
    {
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);
        $seeker_detail = $this->jobseekerDetailRepository->all(['user_id' => $user_id, 'primary_account' => 1])->first();
        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            //update licenses section
            $this->jobSeekerLicenseRepository->syncLicense($request->all(), $user_id, $seeker_detail->id);

            Flash::success('License updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateSeekerLanguageSkill(Request $request)
    {
        // dd($request->all());
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            //update language skill section
            $this->jobSeekerLanguageSkillRepository->synclanguageSkill($request->all(), $user_id);

            Flash::success('Language Skill updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }


    public function updateSeekerSkill(Request $request)
    {
        // dd($request->all());
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);
        $seeker_detail = $this->jobseekerDetailRepository->all(['user_id' => $user_id, 'primary_account' => 1])->first();

        //dd($user->seekerDetail());
        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            //update skill section
            $this->jobSeekerSkillRepository->syncSkill($request->all(), $user_id, $seeker_detail->id);

            Flash::success('Skill updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateSeekerVideo(Request $request)
    {
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            $request->all();
            $document = $request->get('document', []);
            $doc_type = config('constants.document_type.video', 3);
            $this->documentRepository->savePermanent($document, $doc_type, $user);
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function updateSeekerPersonal(Request $request)
    {
        $user_id = $request->user_id;
        $user = $this->repository->find($user_id, ['*'], true);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }

        try {
            // update Seeker Personal Detail [parent_name, DOB, nationality, Language known, permanent addredd]
            //update Personal section
            $seekerDetail = $this->jobseekerDetailRepository->sync($request->all(), $user);

            Flash::success('Personal Detail updated successfully.');
            return redirect()->route('users.profile');
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function deleteItemByType($id, $type)
    {
        if ($type == 'license') {
            $repo = $this->jobSeekerLicenseRepository;
            $item = $repo->find($id);
        }

        if ($type == 'skill') {
            $repo = $this->jobSeekerSkillRepository;
            $item = $repo->find($id);
        }

        if ($type == 'experience') {
            $repo = $this->jobSeekerExperienceRepository;
            $item = $repo->find($id);
        }
        if ($type == 'language_skill') {
            $repo = $this->jobSeekerLanguageSkillRepository;
            $item = $repo->find($id);
        }

        if ($type == 'education') {
            $repo = $this->jobSeekerEducationRepository;
            $item = $repo->find($id);
        }

        if (empty($item)) {
            Flash::error('record not found');

            return redirect()->route('users.profile');
        }

        $repo->delete($id);

        Flash::success('Delete successfully.');

        return redirect()->route('users.profile');
    }

    public function changePassword()
    {
        // Flash::success('Password change successfully.');
        return view('auth.passwords.change_password', ['user' => auth()->user()]);

    }

    public function updatePassword(ChangeUserPasswordRequest $request)
    {
        try {
            $input = $request->all();
            $user = auth()->user();

            throw_if(empty($user), UnauthorizedException::class, 'You are not authorised to process the action.');

            if (Hash::check($input['old_password'], $user->password)) {
                if (Hash::check($input['password'], $user->password)) {
                    Flash::error('Entered new passsword should not be as same as current password.');
                    return redirect()->back();
                }

                $input['password'] = Hash::make($input['password']);
                $user = $this->repository->update($input, $user->id);
                event(new PasswordReset($user));
                // notify to register user
                $user->notify(new PasswordChange($user));
                $success_message = 'Password changed successfully';

                Auth::logout(); // Logout the user

                return redirect()->route('login')->withInput(['toast_success' => $success_message]);
                // Flash::success('Password Changed successfully.');
                // return redirect()->back();
                // return redirect()->route('users.profile')->with('flash_message', 'Password Changed successfully.');
            }
            Flash::error('Wrong Password. Please Provide Correct Current Password');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back();
    }
    public function removeAccount(Request $request)
    {
        try {
            $authuser = auth()->user();
            throw_if(empty($authuser), UnauthorizedException::class, 'You are not authorised to process the action.');

            $user = $this->repository->find($authuser->id, ['*'], true);

            $user->is_deleted = 1;
            $user->save();

            $this->repository->delete($user->id);

            $this->logout($request);
            $user->notify(new AccountRemove($user));


            $input = ['toast_success' => "Account Removed successfully."];
            return redirect()->route('home.verfied')->withInput($input);
        } catch (Throwable $e) {
            Flash::error('Something went wrong, please try again later.');
        }

        return redirect()->back();
    }
    private function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function hideProfile(Request $request, $status = 'false')
    {
        try {
            $authuser = auth()->user();
            throw_if(empty($authuser), UnauthorizedException::class, 'You are not authorised to process the action.');

            $user = $this->repository->find($authuser->id, ['*'], true);

            $user = $this->repository->update(['hide_profile' => $status == 'false' ? false : true], $user->id);

            Flash::success($status == 'false' ? trans('message.unhide_profile') : trans('message.hide_profile'));

            return redirect()->back();
        } catch (Throwable $e) {
            Flash::error('Something went wrong, please try again later.');
        }
        return redirect()->back();
    }

    public function pdfHeader()
    {
        return view('vendor.pdf.header-html');
    }

    public function pdfFooter()
    {
        return view('vendor.pdf.footer-html');
    }

    public function makeCv($id)
    {
        try {
            $jobseeker = $this->repository->find($id, ['*'], true);

            if (empty($jobseeker)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view('users.make_cv', ['jobseeker' => $jobseeker]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function downloadCv($id)
    {
        try {
            $jobseeker = $this->repository->find($id, ['*'], true);

            if (empty($jobseeker)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }
            return $this->repository->getCvPdf($id);
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
    }

    public function downloadProfile($seekerId) {
        try {
            $id = Auth::id();
            $jobseeker = $this->repository->find($id, ['*'], true);
            $jobseekerDetails = $this->jobseekerDetailRepository->find($seekerId, ['*'], true);
            if (empty($jobseeker)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }
            return $this->jobseekerDetailRepository->getCvPdfProfile($seekerId);
        } catch (Throwable $e) { dd($e);
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }

    }
    public function downloadResume($seekerId) {
        try {
            $id = Auth::id();
            $jobseeker = $this->repository->find($id, ['*'], true);
            $jobseekerDetails = $this->jobseekerDetailRepository->find($seekerId, ['*'], true);
            // dd($jobseekerDetails);
            if (empty($jobseeker)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }
            return $this->jobseekerDetailRepository->getCvPdfResume($seekerId);
        } catch (Throwable $e) { dd($e);
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }

    }
    public function downloadAttachment($id)
    {
        try {
            $jobseeker = $this->repository->find($id, ['*'], true);

            if (empty($jobseeker)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }

            $jobseekerDocument = isset($jobseeker->seekerDetail->documents) ? $jobseeker->seekerDetail->documents->first() : '';
            // dd($jobseekerDocument);
            if (empty($jobseekerDocument)) {
                return redirect()->back()->withInput(['toast_error' => 'Attachment not found']);
            }

            $document = $this->documentRepository->find($jobseekerDocument->id);

            if (empty($document)) {
                return redirect()->back()->withInput(['toast_error' => 'Attachment not found']);
            }

            $result = $this->documentRepository->downloadUrl($document->file_path);
            $extension = explode('.', $document->file_name);
            header('Content-length:' . $result['ContentLength']);
            header("Content-Type: {$result['ContentType']}");
            header('Content-Disposition: inline; filename="' . basename($jobseeker->full_name).'.'.end($extension).'"'); // used to download the file.

            echo $result['Body'];
            exit;
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }

        return redirect()->back();
    }

    public function downloadCover($id)
    {
        try {
            $jobseeker = $this->repository->find($id, ['*'], true);

            if (empty($jobseeker)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }

            $jobseekerDocument = isset($jobseeker->seekerDetail->coverDocuments) ? $jobseeker->seekerDetail->coverDocuments->first() : '';
            // dd($jobseekerDocument);
            if (empty($jobseekerDocument)) {
                return redirect()->back()->withInput(['toast_error' => 'Attachment not found']);
            }

            $document = $this->documentRepository->find($jobseekerDocument->id);

            if (empty($document)) {
                return redirect()->back()->withInput(['toast_error' => 'Attachment not found']);
            }

            $result = $this->documentRepository->downloadUrl($document->file_path);
            $extension = explode('.', $document->file_name);
            header('Content-length:' . $result['ContentLength']);
            header("Content-Type: {$result['ContentType']}");
            header('Content-Disposition: inline; filename="' . basename($jobseeker->full_name).'.'.end($extension).'"'); // used to download the file.

            echo $result['Body'];
            exit;
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }

        return redirect()->back();
    }

    public function loginCandidateProfile()
    {
        $id = Auth::user()->id;
        try {
            $candidate = $this->repository->find($id, ['*'], true);
            $candidate_id = $candidate->id;
            $badges = $this->badgeRepository->getBadges($candidate_id);
            // dd($badges);
            $reviews = $this->userReviewRepository->reviews($candidate_id);
            if (empty($candidate)) {
                Flash::error('Candidate not found');

                return redirect(route('my-profile'));
            }
            return view('auth.job_seeker.show', ['candidate' => $candidate, 'entity' => $this->entity,'badges' => $badges, 'reviews' => $reviews]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    // public function editProfileHelp()
    // {
    //     $expertise_plan = $this->packageRepository->all(['package_type' => 3], null, null, [], [], ['created_at' => 'desc']);
    //     return view('auth.job_seeker.profile.help', ['items' => $expertise_plan]);
    // }

    public function payOrder() {
        //$order = $this->orderDetailRepository->orderDetail($order_number);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $price = Configuration::getSessionConfigurationName(['pricing'], null, 'price');

        $gst_percentage = Configuration::getSessionConfigurationName(['pricing'], null, 'gst');
        $total_amount = $price + ($price * ($gst_percentage / 100));

        $orderInfo = $api->order->create([
            'amount' => $total_amount*100, // Amount in paise
            'currency' => 'INR'
        ]);

        $orderId = $orderInfo['id'];
        return view('auth.job_seeker.profile.payment', ['orderId' => $orderId, 'user' => Auth::user(), 'total_amount' => $total_amount]);
    }

    public function events()
    {
        $events = $this->eventRepository->all();
        return view('design.events', ['events' => $events]);
    }

    public function eventshow(Event $event)
    {
        return view('design.eventshow', ['event' => $event]);
    }
}
