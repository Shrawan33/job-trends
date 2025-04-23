<?php

namespace App\Http\Controllers\Front;

use App\DataTables\InterviewScheduleDatatable;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\InterviewScheduleRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\CreateInterviewScheduleRequest;
use App\Http\Requests\UpdateInterviewScheduleRequest;
use Laracasts\Flash\Flash;
use Response;
use Throwable;
use Auth;
use App\Models\ApplyJob;
use App\Models\User;
use App\Models\EmployerJob;
use App\Models\InterviewSchedule;
use App\Mail\InterviewedStatusSendMail;
use Mail;
use App\Models\UserActivity;
use App\Notifications\InterviewedStatus;
use DB;

class InterviewScheduleController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $applicationTrackingRepository;
    public $employerJobRepository;
    public $userRepository;

    public function __construct(InterviewScheduleRepository $interviewScheduleRepository, EmployerJobRepository $employerJobRepo, UserRepository $userRepo)
    {
        $this->repository = $interviewScheduleRepository;
        $this->employerJobRepository = $employerJobRepo;
        $this->userRepository = $userRepo;
        $this->getEntity('interviewschedules');
    }

    /**
     * Display a listing of the .
     *
     * @param InterviewScheduleDatatable $InterviewScheduleDatatable
     * @return Response
     */
    public function index(InterviewScheduleDatatable $interviewScheduleDatatable, $employer_job_id, $user_id)
    {
		if($employer_job_id == 0)
		{
			$employerJob = $this->employerJobRepository->all();
		}
		else
		{
			$employerJob = $this->employerJobRepository->find($employer_job_id, ['*'], true);
		}

		if($user_id == 0)
		{
			$user = $this->userRepository->all();
		}
		else
		{
			$user = $this->userRepository->find($user_id, ['*'], true);
		}

        return $interviewScheduleDatatable->render($this->entity['view'] . '.index', ['employer_job_id' => $employer_job_id, 'entity' => $this->entity, 'employerJob' => $employerJob, 'user_id' => $user_id, 'user' => $user]);
    }

	public function create(Request $request, $employer_job_id, $user_id)
    {
		$users = ApplyJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->where('applied_jobs.employer_job_id', $employer_job_id)->get();

		$employerJob = $this->employerJobRepository->find($employer_job_id, ['*'], true);

		if($user_id != 0)
		{
			$user_id = $this->userRepository->find($user_id, ['*'], true);

			$user = $user_id->id;
		}
		else
		{
			$user = 0;
		}

		try {
            return view($this->entity['view'] . '.create', ['employer_job_id' => $employer_job_id, 'entity' => $this->entity, 'employerJob' => $employerJob, 'users' => $users, 'user_id' => $user_id, 'user' => $user]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

	// public function store(CreateInterviewScheduleRequest $request)
	// {
    //     // dd($request);
	// 	try {
    //         $input = $request->all();
    //         // dd($input);
	// 		$input['user_id'] = Auth::user()->id;
	// 		$employer_job_id = $input['employer_job_id'];

	// 		if(isset($input['users']))
	// 		{
	// 			$input['users'] = implode(',', $input['users']);
	// 		}

	// 		$interviewtype = $this->repository->create($input);

	// 		if(isset($interviewtype->users))
	// 		{
	// 			$user_ids = explode(',', $interviewtype->users);
    //             //$job = EmployerJob::where('id', $employer_job_id)->first();
    //             $employerJob = $this->employerJobRepository->find($employer_job_id, ['*'], true);
	// 			$company = Auth::user();
    //             foreach($user_ids as $user_id)
	// 			{
	// 				//$user = User::where('id', $user_id)->first();
    //                 $user = $this->userRepository->find($user_id, ['*'], true);
    //                 $email = $user->email;
    //                 $user->notify(new InterviewedStatus($employerJob, $company, $interviewtype));
	// 				//Mail::to($email)->send(new InterviewedStatusSendMail($user, $employerJob, $company, $interviewtype));
	// 			}
	// 		}

	// 		$parent_user = Auth::user();

	// 		// if($parent_user->created_by != 1 && $parent_user->created_by != '')
	// 		// {
	// 		// 	$data = new UserActivity();

	// 		// 	$data->user_id = $parent_user->id;
	// 		// 	$data->activity = $parent_user->first_name . ' ' . $parent_user->last_name.' has Create a Interview Schedule from'. ' '. $job->title . ' Job';
	// 		// 	$data->save();
	// 		// }

	// 		// Flash::success('Interview schedule saved successfully.');
    //         $success_message = 'Interview Scheduled Successfully';

    //         return redirect(route($this->entity['url'] . '.index', ['employer_job_id' => $employer_job_id, 'user_id' => 0]))->withInput(['toast_success' => $success_message]);
    //     } catch (Throwable $e) {
    //         throw $e;
    //         Flash::error($e->getMessage());
    //     }
	// }

    public function store(CreateInterviewScheduleRequest $request)
{
    try {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $employer_job_id = $input['employer_job_id'];

        $date = $input['date'];
        $time = $input['time'];

        // Combine the date and time values into a datetime string
        $datetimeValue = $date . ' ' . $time;
        $input['datetime'] = $datetimeValue;

        if (isset($input['users'])) {
            $input['users'] = implode(',', $input['users']);
        }

        $interviewtype = $this->repository->create($input);

        if (isset($interviewtype->users)) {
            $user_ids = explode(',', $interviewtype->users);
            $employerJob = $this->employerJobRepository->find($employer_job_id, ['*'], true);
            $company = Auth::user();
            foreach ($user_ids as $user_id) {
                $user = $this->userRepository->find($user_id, ['*'], true);
                $email = $user->email;
                $user->notify(new InterviewedStatus($employerJob, $company, $interviewtype));
            }
        }

        $success_message = 'Interview Scheduled Successfully';

        return redirect(route($this->entity['url'] . '.index', ['employer_job_id' => $employer_job_id, 'user_id' => 0]))
            ->withInput(['toast_success' => $success_message])
            ->with('datetime', $datetimeValue);
    } catch (Throwable $e) {
        throw $e;
        Flash::error($e->getMessage());
    }
}


	public function show($id = 0)
	{
		try {
            $interview_schedule = InterviewSchedule::where('id', $id)->first();

			$interview_users = explode(",",$interview_schedule->users);

			$interviewusers = User::select(DB::raw("GROUP_CONCAT(CONCAT(first_name,' ',last_name)) as users"))->whereIn('id', $interview_users)->first();

			if($interviewusers)
			{
				$users = $interviewusers->users;
			}
			else
			{
				$users;
			}
            $modal = view($this->entity['view'] . '.show', ['entity' => $this->entity, 'interview_schedule' => $interview_schedule, 'users' => $users])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
	}

	public function edit($employer_job_id, $id)
    {
		$employerJob = $this->employerJobRepository->find($employer_job_id, ['*'], true);

		$users = ApplyJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->where('applied_jobs.employer_job_id', $employer_job_id)->get();

		$user_id = 0;

		try {
            $interviewtype = $this->repository->find($id, ['*'], true);

			$interview_users = explode(',', $interviewtype->users);

			if (empty($interviewtype)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index', $employer_job_id));
            }

			return view($this->entity['view'] . '.edit', ['employerJob' => $employerJob, 'employer_job_id' => $employer_job_id, 'interviewtype' => $interviewtype, 'entity' => $this->entity, 'users' => $users, 'interview_users' => $interview_users, 'user_id' => $user_id]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

	public function update($id, UpdateInterviewScheduleRequest $request)
    {
        try {
            $interviewtype = $this->repository->find($id, ['*'], true);

			$input = $request->all();

			$input['user_id'] = Auth::user()->id;
			$employer_job_id = $input['employer_job_id'];

			if(isset($input['users']))
			{
				$input['users'] = implode(',', $input['users']);
			}

			if (empty($interviewtype)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index', ['employer_job_id' => $employer_job_id, 'user_id' => 0]));
            }

            $interviewtype = $this->repository->update($input, $id, true);

			if(isset($interviewtype->users))
			{
				$user_ids = explode(',', $interviewtype->users);

				foreach($user_ids as $user_id)
				{
					$job = EmployerJob::where('id', $employer_job_id)->first();

					$user = User::where('id', $user_id)->first();

					$company = Auth::user();

					$email = $user->email;

					//Mail::to($email)->send(new InterviewedStatusSendMail($user, $job, $company, $interviewtype));
				}
			}

			$parent_user = Auth::user();

			if($parent_user->created_by != 1 && $parent_user->created_by != '')
			{
				$data = new UserActivity();

				$data->user_id = $parent_user->id;
				$data->activity = $parent_user->first_name . ' ' . $parent_user->last_name.' has Update a Interview Schedule from'. ' '. $job->title . ' Job';
				$data->save();
			}
            $success_message = 'Successfully Updated';

            // Flash::success('Interview schedule updated successfully.');

            return redirect(route($this->entity['url'] . '.index', ['employer_job_id' => $employer_job_id, 'user_id' => 0]))->withInput(['toast_success' => $success_message]);
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
