<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ApplyJobRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\JobAlertRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use stdClass;

class DashboardController extends AppBaseController
{
    private $employerJobRepo;
    private $userRepos;
    private $jobAlertRepo;
    private $applyJobRepo;

    private $totals;
    private $datasets;
    private $labels;

    public function __construct(EmployerJobRepository $employerJobRepo, UserRepository $userRepos, JobAlertRepository $jobAlertRepo, ApplyJobRepository $applyJobRepo)
    {
        $this->employerJobRepo = $employerJobRepo;
        $this->userRepos = $userRepos;
        $this->jobAlertRepo = $jobAlertRepo;
        $this->applyJobRepo = $applyJobRepo;
        $this->count = new stdClass();
        $this->datasets = $this->labels = [];
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function statistics(Request $request)
    {
        $input = $request->all();
        // dd($input['start_date']);
        if ($input['start_date'] == 0) {
            $input = null;
        } else {
            $input['start_date'] = date_create($input['start_date']);
        }

        //sales
        $sales = 0;

        // job_posting
        $employerJob = $this->employerJobRepo->getJobPosted($input, 'count');

        // employer
        $input['role'] = 'employer';
        $employer = $this->userRepos->getUsers($input, 'count');

        // jobseeker
        $input['role'] = 'jobseeker';
        $jobseeker = $this->userRepos->getUsers($input, 'count');

        // application sent
        $application = $this->applyJobRepo->getApplyJobs($input, 'count');

        // jobalert
        $jobalert = $this->jobAlertRepo->getJobAlerts($input, 'count');

        $result = new stdClass();
        $result->sales = $sales;
        $result->employerJob = $employerJob;
        $result->employer = $employer;
        $result->jobseeker = $jobseeker;
        $result->application = $application;
        $result->jobalert = $jobalert;

        return $this->sendResponse($result, 'filtered data');
    }
}
