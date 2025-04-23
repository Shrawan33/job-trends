<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Repositories\EmployerJobRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Helpers\FunctionHelper;
use Auth;
use App\Models\InterviewSchedule;
use App\Models\EmployerJob;
use App\Models\UserPackage;
use App\Models\ApplyJob;
use App\Models\User;
use App\Repositories\ApplyJobRepository;
use App\Repositories\InterviewScheduleRepository;
use DB;
use Carbon\Carbon;

class EmployerDashboardController extends AppBaseController
{
    private $employerJobRepo;
    private $applyJobRepository;
    private $interviewScheduleRepository;

    public function __construct(EmployerJobRepository $employerJobRepo, ApplyJobRepository $applyJobRepo, InterviewScheduleRepository $interviewScheduleRepo)
    {
        $this->employerJobRepo = $employerJobRepo;
        $this->applyJobRepository = $applyJobRepo;
        $this->interviewScheduleRepository = $interviewScheduleRepo;
    }

    public function index()
    {
        $date = date('Y-m-d');
		$user = Auth::user();

		$query = $this->employerJobRepo->allQuery();

        $query->withCount('applyJob');
        $query->scopes('currentUser');
		$query->orderBy('employer_jobs.created_at', 'DESC');
		$query->take(5);
        $myjobs = $query->get();

        $activejobs = EmployerJob::where('expiration_date', '>', $date)->scopes('currentUser')->where('deleted_at', null)->count();


        $statuses = $this->applyJobRepository->status_count_employer();
        $shortlisted_count = $statuses->where('status', 'Shortlisted')->pluck('total')->first();
        $hired_count = $statuses->where('status', 'Hired')->pluck('total')->first();
        $rejected_count = $statuses->where('status', 'Rejected')->pluck('total')->first();
        $pending_count = $statuses->where('status', 'Awaiting Review')->pluck('total')->first();
        $contacting_count = $statuses->where('status', 'Contacting')->pluck('total')->first();
        $query = $this->interviewScheduleRepository->allQuery();
        $query->WithJob();
        $query->where('interview_schedule.created_by', Auth::user()->id);
        $interviewschedulecount = $query->count();

        return view('employer_dashboard')->with('user', $user)->with('myjobs', $myjobs)->with('activejobs', $activejobs)->with('Contacting', $contacting_count)->with('shortlisted', $shortlisted_count)->with('pending', $pending_count)->with('hired', $hired_count)->with('rejected', $rejected_count)->with('interviewschedulecount', $interviewschedulecount);
    }
}
