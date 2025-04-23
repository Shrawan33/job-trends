<?php

namespace App\Widgets;

use App\Helpers\FunctionHelper;
use App\Repositories\ApplyJobRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\JobAlertRepository;
use App\Repositories\UserRepository;
use Arrilot\Widgets\AbstractWidget;

class DashboardList extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'module' => '',
        'heading' => ''
    ];

    private $employerJobRepo;
    private $userRepos;
    private $jobAlertRepo;
    private $applyJobRepo;

    public function __construct(array $config = [], EmployerJobRepository $employerJobRepo, UserRepository $userRepos, JobAlertRepository $jobAlertRepo, ApplyJobRepository $applyJobRepo)
    {
        $this->addConfigDefaults($config);
        parent::__construct($config);
        $this->employerJobRepo = $employerJobRepo;
        $this->userRepos = $userRepos;
        $this->jobAlertRepo = $jobAlertRepo;
        $this->applyJobRepo = $applyJobRepo;
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $result = $this->config + [
            'heading' => $this->config['heading'],
        ];

        $filter['start_date'] = FunctionHelper::today(false, true);
        switch ($this->config['module']) {
            case 'sales':
                $result['count'] = 0;
                break;
            case 'employerJob':
                $result['count'] = $this->employerJobRepo->getJobPosted($filter);
                break;
            case 'employer':
                $filter['role'] = 'employer';
                $result['count'] = $this->userRepos->getUsers($filter);
                break;
            case 'jobseeker':
                $filter['role'] = 'jobseeker';
                $result['count'] = $this->userRepos->getUsers($filter);
                break;
            case 'applyJob':
                $result['count'] = $this->applyJobRepo->getApplyJobs($filter);
                break;
            case 'jobAlert':
                $result['count'] = $this->jobAlertRepo->getJobAlerts($filter);
                break;
        }
        // dd($result);
        return view('widgets.total-count', $result);
    }
}
