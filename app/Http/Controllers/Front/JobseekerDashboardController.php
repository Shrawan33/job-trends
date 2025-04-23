<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Repositories\EmployerJobRepository;
use App\Repositories\FavoriteJobRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Helpers\FunctionHelper;
use Auth;
use App\Models\ApplyJob;
use App\Models\InterviewSchedule;
use App\Models\FavoriteCandidate;
use App\Models\EmployerJob;
use App\Models\JobSeekerSkill;
use App\Repositories\ApplyJobRepository;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class JobseekerDashboardController extends AppBaseController
{
    private $employerJobRepo;
    private $favoriteJobRepo;
    private $applyJobRepository;

    public function __construct(EmployerJobRepository $employerJobRepo, FavoriteJobRepository $favoriteJobRepo, ApplyJobRepository $applyJobRepo)
    {
        $this->employerJobRepo = $employerJobRepo;
        $this->favoriteJobRepo = $favoriteJobRepo;
        $this->applyJobRepository = $applyJobRepo;
    }

    public function index()
    {
        $currentDate = date('Y-m-d');

        $applied_jobs = ApplyJob::select('employer_jobs.*', 'applied_jobs.*', 'users.id as user_id', 'users.company_name')->join('employer_jobs', 'employer_jobs.id', '=', 'applied_jobs.employer_job_id')->join('users', 'users.id', '=', 'employer_jobs.created_by')->where('applied_jobs.user_id', \Auth::user()->id)->where('employer_jobs.expiration_date', '>=', $currentDate)->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0)->count();

        $user = Auth::user();

		$skills  = $user->seekerSkill;

		$jobseekerkill = '';

		foreach($skills as $skill)
		{
			if($jobseekerkill!='')
			{
				$jobseekerkill .= ','.$skill->skill_id;
			}
			else
			{
				$jobseekerkill = $skill->skill_id;
			}
		}

		$jobseeker_skill = explode(',', $jobseekerkill);
        $user = FacadesAuth::user();
		$relatedJobs = EmployerJob::select('employer_jobs.*')->join('employer_jobs_skill', 'employer_jobs_skill.employer_job_id', '=', 'employer_jobs.id')->join('job_seeker_skill', 'job_seeker_skill.skill_id', '=', 'employer_jobs_skill.skill_id')->where('employer_jobs.expiration_date', '>=', $currentDate)->whereIn('job_seeker_skill.skill_id', $jobseeker_skill)->whereNotIN('employer_jobs.id',function($q) use ($user)
        {
            $q->select('employer_job_id')->from('applied_jobs')->where('applied_jobs.user_id',$user->id);
        })->groupBy('employer_jobs.id')->limit('6')->get();
        $myjobs = ApplyJob::select('employer_jobs.*', 'applied_jobs.*', 'users.id as user_id', 'users.company_name')->join('employer_jobs', 'employer_jobs.id', '=', 'applied_jobs.employer_job_id')->join('users', 'users.id', '=', 'employer_jobs.created_by')->where('applied_jobs.user_id', \Auth::user()->id)->where('employer_jobs.expiration_date', '>=', $currentDate)->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0)->orderBy('applied_jobs.created_at', 'DESC')->limit('5')->get();


        $statuses = $this->applyJobRepository->status_count();
        $apply_count = $statuses->where('status', null)->pluck('total')->first();
        $shortlisted_count = $statuses->where('status', 'Shortlisted')->pluck('total')->first();
        $hired_count = $statuses->where('status', 'Hired')->pluck('total')->first();
        $rejected_count = $statuses->where('status', 'Rejected')->pluck('total')->first();
        $pending_count = $statuses->where('status','Awaiting Review')->pluck('total')->first();

        // $interviews = InterviewSchedule::select('interview_schedule.*','employer_jobs.title as job_title','users.id as user_id')->join('employer_jobs', 'employer_jobs.id', '=', 'interview_schedule.employer_job_id')->join('users', 'users.id', '=', 'employer_jobs.created_by')->whereRaw('interview_schedule.datetime >= NOW()')->whereRaw('FIND_IN_SET(?,interview_schedule.users)', [$user->id])->orderBy('interview_schedule.datetime', 'ASC')->limit('5')->get();

        return view('jobseeker_dashboard')->with('applied_jobs', $applied_jobs)->with('active_jobs', $apply_count)->with('shortlisted', $shortlisted_count)->with('hired', $hired_count)->with('rejected', $rejected_count)->with('pending',$pending_count)->with('user', $user)->with('relatedJobs', $relatedJobs)->with('myjobs', $myjobs)->with('user', $user);
    }
}
