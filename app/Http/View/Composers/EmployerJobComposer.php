<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\CategoryRepository;
use App\Repositories\CertificationRepository;
use App\Repositories\WorkTypeRepository;
use App\Repositories\SkillRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\SalaryRepository;
use App\Repositories\InterviewTypeRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\LocationRepository;
use App\Models\EmployerJob;
use App\Models\User;
use App\Repositories\CountryRepository;
use App\Repositories\JobTypeRepository;
use App\Repositories\StateRepository;
use App\Repositories\SpecializationRepository;
use Illuminate\Support\Str;

class EmployerJobComposer
{
    private $repository;
    private $categoryRepository;
    private $workTypeRepository;
    private $skillRepository;
    private $specializationRepository;
    private $experienceRepository;
    private $salaryRepository;
    private $interviewTypeRepository;
    private $certificationRepository;
    private $qualificationRepository;
    private $locationRepository;
    private $stateRepository;
    private $countryRepository;
    private $jobTypeRepository;

    public function __construct(CategoryRepository $cateRepo, WorkTypeRepository $workTypeRepo, SkillRepository $skillRepo, ExperienceRepository $experienceRepo, SalaryRepository $salaryRepo, InterviewTypeRepository $interviewTypeRepo, employerJobRepository $employerJobRepo, QualificationRepository $qualificationRepo, LocationRepository $locationRepo, CertificationRepository $certificationRepo, StateRepository $stateRepo, CountryRepository $countryRepo, JobTypeRepository $jobTypeRepo,SpecializationRepository $specializationRepo)
    {
        $this->categoryRepository = $cateRepo;
        $this->workTypeRepository = $workTypeRepo;
        $this->skillRepository = $skillRepo;
        $this->experienceRepository = $experienceRepo;
        $this->salaryRepository = $salaryRepo;
        $this->interviewTypeRepository = $interviewTypeRepo;
        $this->certificationRepository = $certificationRepo;
        $this->qualificationRepository = $qualificationRepo;
        $this->repository = $employerJobRepo;
        $this->locationRepository = $locationRepo;
        $this->stateRepository = $stateRepo;
        $this->countryRepository = $countryRepo;
        $this->jobTypeRepository = $jobTypeRepo;
        $this->specializationRepository = $specializationRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $action = route('employerJobs.store');
        $categories = ['' => ''] + $this->categoryRepository->all()->pluck('title', 'id')->toArray();

        $workTypes = $this->workTypeRepository->all()->pluck('title', 'id')->toArray();
        $jobTypes = ['' => ''] + $this->jobTypeRepository->all()->pluck('title', 'id')->toArray();

        $workTypesids = null;
        $job_type_id = null;
        $skills = ['' => ''] + $this->skillRepository->all()->pluck('title', 'id')->toArray();
        $specializations = ['' => ''] + $this->specializationRepository->all()->pluck('name', 'id')->toArray();
        $certifications = ['' => ''] + $this->certificationRepository->all()->pluck('title', 'id')->toArray();
        $experinces = ['' => ''] + $this->experienceRepository->all()->pluck('title', 'id')->toArray();
        $salaries = ['' => ''] + $this->salaryRepository->all()->pluck('title', 'id')->toArray();
        $interviewtypes = ['' => ''] + $this->interviewTypeRepository->all()->pluck('title', 'id')->toArray();
        $qualifications = ['' => ''] + $this->qualificationRepository->all()->pluck('title', 'id')->toArray();
        // $locations = ['' => ''] + $this->locationRepository->all()->pluck('title', 'id')->toArray();
        $locations = [];
        $states = [];

        $salary_types = ['' => ''] + config('constants.salary_type.data');
        $salary_type_default = config('constants.salary_type.default', 3); // Yearly
        $skillids = [];
        $specializationids = [];
        $qualificationIDS = [];
        $certificationids = [];
        $totalJobs = [];
        $relatedJobs = [];
        $locationids = [];
        $questionnaires = [];
        $employers = [];
        $employerID = null;
        $pattern = Str::getNextNumber('job_number', EmployerJob::getCounter());
        $id = empty(old()) ? rand(11111, 99999) : old('tmp_id', 0);
        if(!empty($view->employerJob->workTypes)){
            $workTypesids = $view->employerJob->workTypes->pluck('work_type_id')->toArray();

        }
        if ($view->employerJob && $view->employerJob->job_type_id) {
            $job_type_id = $view->employerJob->job_type_id;
        }
        switch ($view->getName()) {
            case 'job_posting.create':
                $employers = User::members(['employer'])->get()->pluck('company_name', 'id');
                    // no break
            case 'employer_jobs.create':
                $questionnaires = EmployerJob::setQuestionnaireSession($id);

                break;
            case 'employer_jobs.show':
                $relatedJobs = $this->repository->getRelatedJobs($view->employerJob);

                break;

            case 'job_posting.edit':
                    $employers = User::members(['employer'])->get()->pluck('company_name', 'id');
                    $employerID = $view->employerJob->created_by ?? '';
                    $skillids = $view->employerJob->skills ? $view->employerJob->skills->pluck('skill_id')->toArray() : [];
                    $qualificationIDS = $view->employerJob->qualifications ? $view->employerJob->qualifications->pluck('qualification_id')->toArray() : [];
                    $certificationids = $view->employerJob->certifications ? $view->employerJob->certifications->pluck('certification_id')->toArray() : [];
                // dd('dd');
                    // no break
            case 'job_posting_mentor.edit':
                    $employers = User::members(['employer'])->get()->pluck('company_name', 'id');
                    $employerID = $view->employerJob->created_by ?? '';
                    // no break
            case 'employer_jobs.edit':
                if ($view->clone === true) {
                    $id = empty(old()) ? rand(11111, 99999) : old('tmp_id', 0);
                    $action = route('employerJobs.clone-store', $view->employerJob->id);
                    $questionnaires = EmployerJob::setQuestionnaireSession($id, []);
                } else {
                    $id = $view->employerJob->id;
                    $action = route('employerJobs.update', $id);
                    $questionnaires = EmployerJob::setQuestionnaireSession($id, !empty($view->employerJob->questionnaire) ? $view->employerJob->questionnaire->all() : []);
                }

                $skillids = $view->employerJob->skills ? $view->employerJob->skills->pluck('skill_id')->toArray() : [];
                // dd($skillids);
                $specializationids = $view->employerJob->specialization ? $view->employerJob->specialization->pluck('id')->toArray() : [];


                $qualificationIDS = $view->employerJob->qualifications ? $view->employerJob->qualifications->pluck('qualification_id')->toArray() : [];
                $certificationids = $view->employerJob->certifications ? $view->employerJob->certifications->pluck('certification_id')->toArray() : [];

                if (!empty($view->employerJob->location)) {
                    $locations = $view->employerJob->location->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                }
                if (!empty($view->employerJob->state)) {
                    $states = $view->employerJob->state->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                }
                break;
            case 'employer_jobs.search-jobs':
                    $totalJobs = $this->repository->all();
                break;
        }

        // if validation fails
        if (!empty(old())) {
            if (!empty(old('location_id'))) {
                $locations = $this->locationRepository->all(['id' => old('location_id')])->pluck('title', 'id')->all();
            }
            if (!empty(old('state_id'))) {
                $states = $this->stateRepository->all(['id' => old('state_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
            }
            // set questionnaire into session
            if (!empty(old('questionnaire'))) {
                $questionnaires = EmployerJob::setQuestionnaireSession($id, old('questionnaire', []));
            }
        }

        $view->with([
            'action' => $action,
            'categories' => $categories,
            'workTypes' => $workTypes,
            'jobTypes' => $jobTypes,
            'workTypesids' => $workTypesids,
            'skills' => $skills,
            'experinces' => $experinces,
            'salaries' => $salaries,
            'skillids' => $skillids,
            'specializationids' => $specializationids,
            'interviewtypes' => $interviewtypes,
            'totalJobs' => $totalJobs,
            'qualifications' => $qualifications,
            'qualificationIDS' => $qualificationIDS,
            'relatedJobs' => $relatedJobs,
            'states' => $states,
            'locations' => $locations,
            'certifications' => $certifications,
            'certificationids' => $certificationids,
            'salary_types' => $salary_types,
            'pattern' => $pattern,
            'salary_type_default' => $salary_type_default,
            'questionnaires' => $questionnaires,
            'id' => $id,
            'employers' => $employers,
            'employerID' => $employerID,
            'job_type_id' => $job_type_id,
            'specializations' => $specializations,
        ]);
    }
}
