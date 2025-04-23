<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\EmployerJobRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\LocationRepository;
use App\Repositories\SalaryRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\StateRepository;
use App\Repositories\WorkTypeRepository;
use App\Repositories\SpecializationRepository;
use App\Repositories\JobTypeRepository;



class JobSearchComposer
{
    private $employerJobRepository;
    private $categoryRepository;
    private $salaryRepository;
    private $experienceRepository;
    private $qualificationRepository;
    private $locationRepository;
    private $workTypeRepository;
    private $stateRepository;
    private $specializationRepository;
    private $jobTypeRepository;


    public function __construct(EmployerJobRepository $EmployerJobRepo, CategoryRepository $cateRepo, SalaryRepository $SalaryRepo, ExperienceRepository $ExperienceRepo, QualificationRepository $QualificationRepo, LocationRepository $locationRepo, WorkTypeRepository $workTypeRepo, StateRepository $stateRepo, SpecializationRepository $specializationRepo,JobTypeRepository $jobTypeRepo)
    {
        $this->categoryRepository = $cateRepo;
        $this->salaryRepository = $SalaryRepo;
        $this->experienceRepository = $ExperienceRepo;
        $this->qualificationRepository = $QualificationRepo;
        $this->employerJobRepository = $EmployerJobRepo;
        $this->locationRepository = $locationRepo;
        $this->workTypeRepository = $workTypeRepo;
        $this->stateRepository = $stateRepo;
        $this->specializationRepository = $specializationRepo;
        $this->jobTypeRepository = $jobTypeRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $locationFilter = ['' => ''] + $this->locationRepository->all()->pluck('title', 'id')->toArray();
        $stateFilter = ['' => ''] +  [' ' => 'All Specialization'] + $this->stateRepository->all()->pluck('title', 'id')->toArray();
        $categoryFilter = $this->categoryRepository->all()->pluck('title', 'id')->toArray();
        $salaryFilter = $this->salaryRepository->all()->pluck('title', 'id')->toArray();
        $experinceFilter = $this->experienceRepository->all()->pluck('title', 'id')->toArray();
        $qualificationFilter = $this->qualificationRepository->all()->pluck('title', 'id')->toArray();
        $specializationFilter =  ['' => ''] +  [' ' => 'All Specialization'] + $this->specializationRepository->all()->pluck('name', 'id')->toArray();
        $jobTypeFilter = $this->workTypeRepository->all()->pluck('title', 'id')->toArray();
        $jobTypeFilterValues =  $this->workTypeRepository->all()->pluck('title', 'title')->toArray();
        $jobTypes = ['' => ''] +  [' ' => 'All Job Position']+ $this->jobTypeRepository->all()->pluck('title', 'id')->toArray();
        // $featuredJobs = $this->employerJobRepository->getFeaturedJobs();

        $salaryTypeFilter = config('constants.salary_type.data');
        $relatedJobs = [];
        $prefix = '';

        $formUrl = route('search-jobs.index');
        if ($view->employerJob && $view->employerJob->job_type_id) {
            $job_type_id = $view->employerJob->job_type_id;
        }
        if(!empty($view->specializations && $view->employerJob->specialization_id)){
            $specializations =$view->specializations->employerJob->specialization_id;
        }
        switch ($view->getName()) {
            case 'search_jobs.index':

                if (isset($view->slug)) {
                    $formUrl = route('search-jobs.category.search', $view->slug);
                    $categoryFilter = $this->categoryRepository->find($view->slug, ['*'], false, true);
                }
                if ($view->entity['prefix'] == 'account') {
                    $prefix = 'account.' ;
                } elseif ($view->entity['prefix'] == 'mentor') {
                    $prefix = 'mentor.';
                } else {
                    $prefix = null;
                }
                break;
            case 'search_jobs.show':
                $relatedJobs = $this->employerJobRepository->all(['category_id' => $view->employerJob->category_id]);
                break;
        }
        // dd($prefix);
        return $view->with([
            'locationFilter' => $locationFilter,
            'stateFilter' => $stateFilter,
            'categoryFilter' => $categoryFilter,
            'salaryFilter' => $salaryFilter,
            'experinceFilter' => $experinceFilter,
            'qualificationFilter' => $qualificationFilter,
            'relatedJobs' => $relatedJobs,
            'jobTypeFilter' => $jobTypeFilter,
            'jobTypeFilterValues' => $jobTypeFilterValues,
            'salaryTypeFilter' => $salaryTypeFilter,
            'formUrl' => $formUrl,
            'prefix' => $prefix,
            'specializationFilter' => $specializationFilter,
            'jobTypes' => $jobTypes,
        ]);
    }
}
