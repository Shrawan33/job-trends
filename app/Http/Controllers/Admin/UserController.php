<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Events\NewUser;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Imports\SchoolImport;
use App\Imports\StateDistrictImport;
use App\Models\ApplicationTracking;
use App\Models\ApplyJob;
use App\Models\EmployerJob;
use App\Models\InterviewSchedule;
use App\Models\JobAlert;
use App\Models\JobSeekerDetail;
use App\Models\JobSeekerEducation;
use App\Models\JobSeekerExperience;
use App\Models\JobSeekerLicense;
use App\Models\JobSeekerSkill;
use App\Models\UserProfile;
use App\Notifications\NewUserNotification;
use App\Repositories\AssignEmployerRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Throwable;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends AppBaseController
{
    /**
     * Store a newly created User in storage.
     *
     * @param CreateAdminUserRequest $request
     *
     * @return Response
     */
    // public function store(CreateAdminUserRequest $request)
    // {
    //     try {
    //         $input = $request->all();
    //         // dd($input);
    //         $role = $input['role'];
    //         $input['password'] = Hash::make($input['password']);

    //         $input['email_verified_at'] = $request->get('email_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
    //         $input['mobile_verified_at'] = $request->get('mobile_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
    //         $user = $this->repository->create($input);
    //         // assign role
    //         if (!empty($role)) {
    //             $user->assignRole($role);
    //         }

    //         event(new NewUser($user));

    //         return $this->sendResponse($user, $this->entity['singular'] . ' saved successfully.');
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }

    /** @var $repository repository */
    public $repository;
    public $assignEmployerRepository;

    public function __construct(UserRepository $userRepo, AssignEmployerRepository $assignEmployerRepo)
    {
        $this->repository = $userRepo;
        $this->assignEmployerRepository = $assignEmployerRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        try {
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    // public function store(CreateAdminUserRequest $request)
    // {
    //     try {
    //         $input = $request->all();
    //         $role = $input['role'];

    //         // Generate a random password
    //         $randomPassword = Str::random(8);
    //         //$randomPassword = 'jamaica123';
    //         $hashedPassword = Hash::make($randomPassword);

    //         $input['password'] = $hashedPassword;

    //         $input['email_verified_at'] = $request->get('email_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
    //         $input['mobile_verified_at'] = $request->get('mobile_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
    //         $user = $this->repository->create($input);

    //         // assign role
    //         if (!empty($role)) {
    //             // dd($role);
    //             $user->assignRole($role);
    //         }


    //         event(new NewUser($user));

    //         // Send email notification to the newly created user

    //         $user->notify(new NewUserNotification($user, $randomPassword, $role));
    //         return $this->sendResponse($user, $this->entity['singular'] . ' saved successfully.');
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }
    public function store(CreateAdminUserRequest $request)
    {
        try {
            $input = $request->all();
            $role = $input['role'];

            // Generate a random password
            $randomPassword = Str::random(8);
            //$randomPassword = 'jamaica123';
            $hashedPassword = Hash::make($randomPassword);

            $input['password'] = $hashedPassword;

            $input['email_verified_at'] = FunctionHelper::today(false, true, true); // Set the email_verified_at by default
            $input['mobile_verified_at'] = $request->get('mobile_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
            $user = $this->repository->create($input);

            // assign role
            if (!empty($role)) {
                // dd($role);
                $user->assignRole($role);
            }

            event(new NewUser($user));

            // Send email notification to the newly created user
            $user->notify(new NewUserNotification($user, $randomPassword, $role));
            return $this->sendResponse($user, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = $this->repository->find($id, ['*'], true);

            if (empty($user)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['user' => $user, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $user = $this->repository->find($id, ['*'], true);

            if (empty($user)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $user->mobile_verified_at = $user->mobile_verified_at != null ? 1 : null;
                $user->email_verified_at = $user->email_verified_at != null ? 1 : null;
                $modal = view($this->entity['view'] . '.edit', ['user' => $user, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            throw $e;
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateAdminUserRequest $request
     *
     * @return Response
     */
    // public function update($id, UpdateAdminUserRequest $request)
    // {
    //     try {
    //         $user = $this->repository->find($id, ['*'], true);

    //         if (empty($user)) {
    //             return $this->sendError($this->entity['singular'] . ' not found');
    //         } else {
    //             $input = $request->all();
    //             if (!empty($input['password'])) {
    //                 $input['password'] = Hash::make($input['password']);
    //             } else {
    //                 unset($input['password']);
    //             }
    //             if ($user->email_verified_at == null) {
    //                 $input['email_verified_at'] = $request->get('email_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
    //             } else {
    //                 unset($input['email_verified_at']);
    //             }
    //             if ($user->mobile_verified_at == null) {
    //                 $input['mobile_verified_at'] = $request->get('mobile_verified_at', null) == 1 ? FunctionHelper::today(false, true, true) : null;
    //             } else {
    //                 unset($input['mobile_verified_at']);
    //             }
    //             $user = $this->repository->update($input, $id, true);

    //             $user->syncRoles([$input['role']]);

    //             return $this->sendResponse($user, $this->entity['singular'] . ' updated successfully.');
    //         }
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }
    public function update($id, UpdateAdminUserRequest $request)
    {
        try {
            $user = $this->repository->find($id, ['*'], true);

            if (empty($user)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $input = $request->all();
                if (!empty($input['password'])) {
                    $input['password'] = Hash::make($input['password']);
                } else {
                    unset($input['password']);
                }

                if ($request->has('email_verified_at')) {
                    $input['email_verified_at'] = $request->input('email_verified_at') ? FunctionHelper::today(false, true, true) : null;
                }

                if ($request->has('mobile_verified_at')) {
                    $input['mobile_verified_at'] = $request->input('mobile_verified_at') ? FunctionHelper::today(false, true, true) : null;
                }

                $user = $this->repository->update($input, $id, true);

                $user->syncRoles([$input['role']]);
                // Flash::success($this->entity['singular'] . ' Updated Successfully.');
                // Flash::success($this->entity['singular'] . ' Updated Successfully');

                // return redirect(route($this->entity['url'] . '.index'));
                return $this->sendResponse($user, $this->entity['singular'] . ' Updated Successfully');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    //open form of assign employer to account manager
    public function assignToAccountManagerForm($id)
    {
        try {
            $employer = $this->repository->find($id, ['*'], true);

            if (empty($employer)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.assign_form', ['employer' => $employer, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            throw $e;
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    //employer assign to account manager
    public function assignTo(Request $request)
    {
        try {
            $input = $request->all();
            $modal = $this->assignEmployerRepository->sync($input);
            return $this->sendResponse($modal, 'Employer Assigned...');
        } catch (Throwable $e) {
            throw $e;
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function Verified($id, Request $request)
    {
        try {
            $user = $this->repository->find($id, ['*'], true);

            if (empty($user)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $input['email_verified_at'] = FunctionHelper::today(false, true, true);
                $user = $this->repository->update($input, $id, true);
                Flash::success($this->entity['singular'] . ' Verified successfully.');
                return redirect(route($this->entity['url'] . '.index'));
            }
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function getImportfile()
    {
        $modal = view($this->entity['view'] . '.import')->render();

        return $this->sendResponse($modal, '');
    }

    public function import(Request $request)
    {
        if ($request->file('import_file')) {

            Excel::import(new SchoolImport(), $request->file('import_file')); // Import school data
            return $this->sendResponse([], 'Import successfully.');
        } else {
            return $this->sendError('Import file not found');
        }
    }

    // public function updateDestroy($id, Request $request)
    // {
    //     try {
    //         $user = $this->repository->find($id, ['*'], true);

    //         if (empty($user)) {
    //             return $this->sendError($this->entity['singular'] . ' not found');
    //         } else {
    //             $input = $request->all();

    //             // Check if the user has the 'jobseeker' role
    //             if ($user->hasRole('jobseeker')) {

    //                 $user_delete = $user;
    //                 // dd($user_delete );
    //                 dd("hard delete");
    //                 $user_delete->forceDelete();
    //                 $success_message = 'User Deleted Successfully';

    //                 // Flash::success($this->entity['singular'] . ' Remove from favourit List successfully');
    //                 return redirect()->back()->withInput(['toast_success' => $success_message]);
    //             }
    //             else{
    //                 dd("Soft delete");
    //                 $user->delete();
    //                 $success_message = 'User Deleted Successfully';
    //             }
    //         }
    //     } catch (Throwable $e) {
    //         return $this->sendError($this->entity['singular'] . ' not found1111');
    //     }
    // }

    // public function updateDestroy($id, Request $request)
    // {
    //     $record = $this->repository->find($id, ['*'], true);
    //     $message = '';
    //     // dd($this->entity);
    //     if (empty($record)) {
    //         return $this->sendError($this->entity['view'] . ' not found');
    //     }

    //     try {
    //         switch ($request->method()) {
    //             case 'PATCH':
    //                 if ($request->get('process', null) == 'restore') {
    //                     if ($this->entity['view'] == 'employer_jobs') {
    //                         $message = 'Activate';
    //                     } else {
    //                         $message = 'Activate';
    //                     }
    //                     $record = $this->repository->restore($id);
    //                 } else {
    //                     $input = $request->only('status');
    //                     $message = 'status updated';
    //                     $record = $this->repository->update($input, $id);
    //                 }
    //                 break;
    //             case 'DELETE':
    //                 if ($request->get('process', null) == 'archive') {
    //                     if ($this->entity['view'] == 'employer_jobs') {
    //                         $message = 'Deactivate';
    //                     } else {
    //                         $message = 'Deactivate';
    //                     }
    //                 } else {
    //                     if ($record->hasRole('jobseeker')) {

    //                         // dd("permenent delete");
    //                         $message = 'Deleted ';
    //                         $user_delete = $record; // Assuming you have already defined $user.
    //                         $user_delete->appliedJobs()->forceDelete($id);
    //                         $user_delete->forceDelete($id);

    //                     } else {
    //                         // dd('soft delete');
    //                         $message = 'Deleted ';
    //                         $record->is_deleted = 1;
    //                         $record->save();
    //                         $this->repository->delete($id);
    //                     }
    //                     // $message = 'Deleted ';
    //                     // $record->is_deleted = 1;
    //                     // $record->save();
    //                 }
    //                 // $this->repository->delete($id);
    //                 break;
    //             default:
    //                 return $this->sendError('Invalid method used, only Patch or Delete allowed.', 400);
    //                 break;
    //         }
    //         return $this->sendResponse($record, " $message Successfully");
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }

    public function updateDestroy($id, Request $request)
    {
        $record = $this->repository->find($id, ['*'], true);
        $message = '';

        if (empty($record)) {
            return $this->sendError($this->entity['view'] . ' not found');
        }

        try {
            switch ($request->method()) {
                case 'PATCH':
                    // if ($request->get('process', null) == 'restore') {
                    //     if ($this->entity['view'] == 'employer_jobs') {
                    //         $message = 'Activate';
                    //     } else {
                    //         $message = 'Activate';
                    //     }
                    //     $record = $this->repository->restore($id);
                    // } else {
                    //     $input = $request->only('status');
                    //     $message = 'status updated';
                    //     $record = $this->repository->update($input, $id);
                    // }

                    if ($request->get('process', null) == 'restore') {
                        if ($this->entity['view'] == 'employer_jobs') {
                            $message = 'Activate';
                        } else {
                            $message = 'Activate';
                        }
                        $record = $this->repository->restore($id);

                    // // Activate related jobs
                    // $relatedJobs = EmployerJob::where('created_by', $record->id)->get(); // Fetch related jobs
                    // dd($relatedJobs);
                    // foreach ($relatedJobs as $job) {
                    //     $job->is_deleted = 0; // Set the status to activated or any other desired value
                    //     $job->save(); // Save the changes
                    // }
                    } else {
                        $input = $request->only('status');
                        $message = 'status updated';
                        $record = $this->repository->update($input, $id);

                        // Update related jobs if necessary
                        // ...
                    }

                    break;
                case 'DELETE':
                    if ($request->get('process', null) == 'archive') {
                        if ($this->entity['view'] == 'employer_jobs') {
                            $message = 'Deactivate';
                        } else {
                            $message = 'Deactivate';
                        }

                    } else {
                        if ($record->is_deleted === 1) {
                            $message = 'Deleted ';
                            $record->is_deleted = 1;
                            $record->save();
                            $this->repository->delete($id);
                            // Delete related records
                            ApplyJob::where('user_id', $record->id)->forceDelete();
                            UserProfile::where('user_id', $record->id)->forceDelete();
                            JobSeekerDetail::where('user_id', $record->id)->forceDelete();
                            ApplicationTracking::where('user_id', $record->id)->forceDelete();
                            JobAlert::where('created_by', $record->id)->forceDelete();
                            InterviewSchedule::where('users', $record->id)->forceDelete();
                            JobSeekerEducation::where('user_id', $record->id)->forceDelete();
                            JobSeekerExperience::where('user_id', $record->id)->forceDelete();
                            JobSeekerLicense::where('user_id', $record->id)->forceDelete();
                            JobSeekerSkill::where('user_id', $record->id)->forceDelete();

                            // Then, delete the main record
                            $message = 'Deleted ';
                            $record->forceDelete();
                        } else {
                            // Soft delete for non-jobseeker
                            // $message = 'Deleted ';
                            // $record->is_deleted = 1;
                            // $record->save();
                            // $this->repository->delete($id);

                            $message = 'Deleted ';
                            $record->is_deleted = 1;
                            $record->save();
                            $this->repository->delete($id);

                            // Soft delete related records in the EmployerJob table
                            $relatedJobs = EmployerJob::where('created_by', $record->id)->get(); // Fetch related jobs
                            foreach ($relatedJobs as $job) {
                                $job->is_deleted = 1;
                                $job->save(); // Soft delete related records
                            }
                        }
                    }
                    break;

                default:
                    return $this->sendError('Invalid method used, only Patch or Delete allowed.', 400);
                    break;
            }
            return $this->sendResponse($record, " $message Successfully");
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }


    public function loginbyid($id, Request $request)
    {
            $user = $this->repository->find($id, ['*'], true);
            Auth::user()->impersonate($user);
            //Auth::login($user);
            if($user->hasRole('employer')){

                return redirect('employerDashboard');
            }
            elseif($user->hasRole('jobseeker')){

                return redirect('jobseekerDashboard');
            }
    }

}
