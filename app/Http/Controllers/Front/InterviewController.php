<?php

namespace App\Http\Controllers\Front;

use App\DataTables\InterviewDatatable;
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
use DB;

class InterviewController extends AppBaseController
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
        $this->getEntity('interviews');
    }

    /**
     * Display a listing of the .
     *
     * @param InterviewScheduleDatatable $InterviewScheduleDatatable
     * @return Response
     */
    public function index(InterviewDatatable $interviewDatatable)
    {
        return $interviewDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }
	
	public function create($id = 0)
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
				$users = '';
			}
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'interview_schedule' => $interview_schedule, 'users' => $users])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
	}
}
