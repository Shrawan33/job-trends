<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EmployerJobReportDataTable;
use App\DataTables\EmployerReportDataTable;
use App\DataTables\JobseekerReportDataTable;
use App\DataTables\PackageReportDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EmployerJobRepository;
use App\Repositories\UserRepository;

class ReportController extends AppBaseController
{
    private $employerJob;
    private $user;

    public function __construct(EmployerJobRepository $employerJobRepo, UserRepository $userRepo)
    {
        $this->employerJob = $employerJobRepo;
        $this->user = $userRepo;
        $this->getEntity('filter-reports');
    }

    public function employerReports(EmployerReportDataTable $employerReportDataTable)
    {
        return $employerReportDataTable->render($this->entity['view'] . '.employer', ['entity' => $this->entity]);
    }

    public function jobseekerReports(JobseekerReportDataTable $jobseekerReportDataTable)
    {
        return $jobseekerReportDataTable->render($this->entity['view'] . '.jobseeker', ['entity' => $this->entity]);
    }

    public function JobsReports(EmployerJobReportDataTable $jobReportDataTable)
    {
        return $jobReportDataTable->render($this->entity['view'] . '.job', ['entity' => $this->entity]);
    }

    public function packageReports(PackageReportDataTable $packageReportDataTable)
    {
        return $packageReportDataTable->render($this->entity['view'] . '.package', ['entity' => $this->entity]);
    }
}
