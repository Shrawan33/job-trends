<?php

namespace App\Http\View\Composers;

use App\Helpers\FunctionHelper;
use App\Repositories\CertificationRepository;
use App\Repositories\CountryRepository;
use Illuminate\View\View;
use App\Repositories\QualificationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\JobSeekerEducationRepository;
use App\Repositories\JobSeekerExperienceRepository;
use App\Repositories\JobSeekerLicenseRepository;
use App\Repositories\JobSeekerSkillRepository;
use App\Repositories\jobSeekerLanguageSkillRepository;
use App\Repositories\JobSeekerVideoRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\JobSeekerWorkTypeRepository;
use App\Repositories\SpecializationRepository;
use App\Repositories\LocationRepository;
use App\Repositories\SalaryRepository;
use App\Repositories\StateRepository;
use App\Repositories\WorkTypeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\LevelRepository;



use Illuminate\Support\Facades\Auth;

class JobSeekerComposer
{
    private $qualificationRepository;
    private $experienceRepository;
    private $skillRepository;
    private $jobSeekerEducationRepository;

    public $jobSeekerExperienceRepository;
    public $jobSeekerLanguageSkillRepository;
    public $jobSeekerLicenseRepository;
    public $LanguageRepository;
    public $LevelRepository;
    public $jobSeekerSkillRepository;
    public $jobSeekerVideoRepository;
    public $salaryRepository;
    private $specializationRepository;
    private $locationRepository;
    private $stateRepository;
    private $categoryRepository;

    private $seekerDetailRepository;
    private $jobSeekerWorkTypeRepository;
    private $countryRepository;
    private $workTypeRepository;
    private $certificateRepository;

    public function __construct(QualificationRepository $qualificationRepo, ExperienceRepository $experienceRepo, JobSeekerEducationRepository $jobSeekerEducationRepo, JobSeekerExperienceRepository $jobSeekerExperienceRepo, JobSeekerLicenseRepository $jobSeekerLicenseRepo, jobSeekerLanguageSkillRepository $jobseekerLanguageSkillRepo, JobSeekerSkillRepository $jobSeekerSkillRepo, JobSeekerVideoRepository $jobSeekerVideoRepo, SkillRepository $skillRepo, SalaryRepository $salaryRepo, SpecializationRepository $specializationRepo, LocationRepository $locationRepo, JobSeekerDetailRepository $jobSeekerDetailRepo, WorkTypeRepository $workTypeRepo, StateRepository $stateRepo, CertificationRepository $certificateRepo, JobSeekerWorkTypeRepository $jobSeekerWorkTypeRepo, CountryRepository $countryRepo, CategoryRepository $categoryRepo, LanguageRepository $LanguageRepo, LevelRepository $LevelRepo)
    {
        $this->qualificationRepository = $qualificationRepo;
        $this->experienceRepository = $experienceRepo;
        $this->jobSeekerEducationRepository = $jobSeekerEducationRepo;
        $this->jobSeekerExperienceRepository = $jobSeekerExperienceRepo;
        $this->jobSeekerLicenseRepository = $jobSeekerLicenseRepo;
        $this->jobSeekerLanguageSkillRepository = $jobseekerLanguageSkillRepo;
        $this->jobSeekerSkillRepository = $jobSeekerSkillRepo;
        $this->jobSeekerVideoRepository = $jobSeekerVideoRepo;
        $this->skillRepository = $skillRepo;
        $this->certificateRepository = $certificateRepo;
        $this->workTypeRepository = $workTypeRepo;
        $this->salaryRepository = $salaryRepo;
        $this->specializationRepository = $specializationRepo;
        $this->locationRepository = $locationRepo;
        $this->stateRepository = $stateRepo;
        $this->categoryRepository = $categoryRepo;
        $this->seekerDetailRepository = $jobSeekerDetailRepo;
        $this->jobSeekerWorkTypeRepository = $jobSeekerWorkTypeRepo;
        $this->countryRepository = $countryRepo;
        $this->LanguageRepository = $LanguageRepo;
        $this->LevelRepository = $LevelRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $educations = $this->qualificationRepository->all()->pluck('title', 'id')->toArray();
        $languages = $this->LanguageRepository->all()->pluck('title', 'id')->toArray();
        $speaks = $this->LevelRepository->all()->pluck('title', 'id')->toArray();
        $read_write = $this->LevelRepository->all()->pluck('title', 'id')->toArray();

        $experiences = $this->experienceRepository->all()->pluck('title', 'id')->toArray();
        $salaries = $this->salaryRepository->all()->pluck('title', 'id')->toArray();
        $skills = $this->skillRepository->all()->pluck('title', 'id')->toArray();
        $licenses = $this->certificateRepository->all()->pluck('title', 'id')->toArray();
        $workTypes = $this->workTypeRepository->all()->pluck('title', 'id')->toArray();
        $specializations = $this->specializationRepository->all()->pluck('name', 'id')->toArray();
        $category = $this->categoryRepository->all()->pluck('title', 'id')->toArray();
        $gender = ['' => ''] + config('constants.gender');
        $marital_status = ['' => ''] + config('constants.marital_status');
        $currency = ['' => ''] + config('constants.currency');
        $religion = ['' => ''] + config('constants.religion');
        $salaryTypes = config('constants.salary_type.data');
        $salary_type_default = config('constants.salary_type.default', 3); // Yearly
        // $specializations = [];
        $locations = [];
        $city_preference = [];
        // $category = [];
        $states = [];
        $countries = [];
        $nationality = [];
        $listEducation = null;
        $listExperience = null;
        $listLicense = null;
        $listLanguageSkill = null;
        $listSkill = null;
        $listVideo = null;
        $educationsData = null;
        $licenseData = null;
        $experiencesData = null;
        $language_skillData = null;
        $skillsData = null;
        $videodata = null;
        $dob = null;
        $workTypesids = null;
        $seekerDetail = !empty($view->user->seekerDetail) ? $view->user->seekerDetail : $this->seekerDetailRepository->makeModel();
        // dd($seekerDetail->category );

        switch ($view->getName()) {
            case 'auth.job_seeker.profile.show':
                $user_id = Auth::user()->id;
                $listEducation = $this->jobSeekerEducationRepository->all(['user_id' => $user_id, 'seeker_detail_id' => $seekerDetail->id]);
                $listExperience = $this->jobSeekerExperienceRepository->all(['user_id' => $user_id, 'seeker_detail_id' => $seekerDetail->id]);
                $listLicense = $this->jobSeekerLicenseRepository->all(['user_id' => $user_id, 'seeker_detail_id' => $seekerDetail->id]);
                $listSkill = $this->jobSeekerSkillRepository->all(['user_id' => $user_id, 'seeker_detail_id' => $seekerDetail->id]);
                $listLanguageSkill = $this->jobSeekerLanguageSkillRepository->all(['user_id' => $user_id]);
                $listVideo = $this->jobSeekerVideoRepository->all(['user_id' => $user_id]);
                break;

            case 'auth.job_seeker.partials.intro':


            case 'auth.job_seeker.profile.edit':
                // $specializations = $this->specializationRepository->all()->pluck('name', 'id')->toArray();
                if ($view->main_title == 'education') {
                    if (!empty(old())) {
                        $data = [];
                        foreach (old('qualification_id') as $key => $value) {
                            $data[$key]['qualification_id'] = $value;
                            $data[$key]['university'] = old('university')[$key] ?? null;
                            $data[$key]['duration_from'] = old('duration_from')[$key] ?? null;
                            $data[$key]['duration_to'] = old('duration_to')[$key] ?? null;
                            $data[$key]['from_month'] = old('from_month')[$key] ?? null;
                            $data[$key]['to_month'] = old('to_month')[$key] ?? null;
                        }
                        $educationsData = collect(array_values($data));
                    } else {
                        $educationsData = $this->jobSeekerEducationRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $educationsData = $educationsData->count() > 0 ? $educationsData : [];
                    }
                }

                if ($view->main_title == 'experience') {
                    if (!empty(old())) {
                        $data = [];
                        foreach (old('company') as $key => $value) {
                            $data[$key]['company'] = $value;
                            $data[$key]['role'] = old('role')[$key] ?? null;
                            $data[$key]['duration_from'] = old('duration_from')[$key] ?? null;
                            $data[$key]['duration_to'] = old('duration_to')[$key] ?? null;
                            $data[$key]['description'] = old('description')[$key] ?? null;
                        }
                        $experiencesData = collect(array_values($data));
                    } else {
                        $experiencesData = $this->jobSeekerExperienceRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $experiencesData = $experiencesData->count() > 0 ? $experiencesData : [];
                    }
                }

                // if ($view->main_title == 'licenses') {
                //     $licenseData = $this->jobSeekerLicenseRepository->all(['user_id' => $view->user->id]);
                //     $licenseData = $licenseData->count() > 0 ? $licenseData : [];
                // }

                if ($view->main_title == 'licenses') {
                    if (!empty(old())) {
                        $data = [];
                        foreach (old('certificate_name') as $key => $value) {
                            $data[$key]['certificate_name'] = $value;
                            $data[$key]['certifying_authority'] = old('certifying_authority')[$key] ?? null;
                            $data[$key]['from_month'] = old('from_month')[$key] ?? null;
                            $data[$key]['to_month'] = old('to_month')[$key] ?? null;
                            $data[$key]['from_year'] = old('from_year')[$key] ?? null;
                            $data[$key]['to_year'] = old('to_year')[$key] ?? null;
                        }
                        $licenseData = collect(array_values($data));
                    } else {
                        $licenseData = $this->jobSeekerLicenseRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $licenseData = $licenseData->count() > 0 ? $licenseData : [];
                    }
                }
                if ($view->main_title == 'language_skill') {
                    if (!empty(old())) {
                        $data = [];
                        foreach (old('language_id') as $key => $value) {
                            $data[$key]['language_id'] = $value;
                            $data[$key]['speak_id'] = old('speak_id')[$key] ?? null;
                            $data[$key]['read_write_id'] = old('read_write_id')[$key] ?? null;
                        }
                        $language_skillData = collect(array_values($data));
                    } else {
                        $language_skillData = $this->jobSeekerLanguageSkillRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $language_skillData = $language_skillData->count() > 0 ? $language_skillData : [];
                    }
                }
                if ($view->main_title == 'skill') {

                    $skillsData = $this->jobSeekerSkillRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                    $skillsData = $skillsData->count() > 0 ? $skillsData : [];


                }

                if ($view->main_title == 'video') {
                    $videodata = $this->jobSeekerVideoRepository->all(['user_id' => $view->user->id]);
                }

                if ($view->main_title == 'intro') {
                    if (!empty($seekerDetail->specializations)) {
                        $specializations = $seekerDetail->specializations->pluck('specialization_id')->toArray();
                    }
                    if (!empty($seekerDetail->category)) {
                        $category = isset($seekerDetail->category) ? $seekerDetail->category->pluck('title', 'id')->toArray() : [];
                    }
                    if (!empty($seekerDetail->workTypes)) {
                        $workTypesids = $seekerDetail->workTypes->pluck('work_type_id')->toArray();
                    }
                    if (!empty(old())) {
                        if (!empty(old('location_id'))) {
                            $locations = $this->locationRepository->all(['id' => old('location_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                        }
                        if (!empty(old('state_id'))) {
                            $states = $this->stateRepository->all(['id' => old('state_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                        }
                        if (!empty(old('country_id'))) {
                            $countries = $this->countryRepository->all(['id' => old('country_id')], null, null, [], [], ['name' => 'ASC'])->pluck('name', 'id')->all();
                        }
                        if (!empty(old('city_preference'))) {
                            $city_preference = $this->locationRepository->all(['id' => old('city_preference')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                        }
                        // if (!empty(old('category_id'))) {
                        //     $category = $this->categoryRepository->all(['id' => old('category_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                        // }
                    } else {
                        if (!empty($seekerDetail->location)) {
                            $locations = $seekerDetail->location->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                        }
                        if (!empty($seekerDetail->state)) {
                            $states = $seekerDetail->state->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                        }
                        if (!empty($seekerDetail->country_id)) {
                            $countries = $seekerDetail->country->pluck('name', 'id')->all([], null, null, [], [], ['name' => 'ASC']);
                        }
                        if (!empty($seekerDetail->city_preference)) {
                            $city_preference = $seekerDetail->location->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                        }
                        // if (!empty($seekerDetail->category)) {
                        //     $category = $seekerDetail->category->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                        // }
                    }

                    if (!empty(old())) {
                        $data = [];
                        foreach (old('company') as $key => $value) {
                            $data[$key]['company'] = $value;
                            $data[$key]['role'] = old('role')[$key] ?? null;
                            $data[$key]['duration_from'] = old('duration_from')[$key] ?? null;
                            $data[$key]['duration_to'] = old('duration_to')[$key] ?? null;
                            $data[$key]['description'] = old('description')[$key] ?? null;
                        }
                        $experiencesData = collect(array_values($data));
                    } else {
                        $experiencesData = $this->jobSeekerExperienceRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $experiencesData = $experiencesData->count() > 0 ? $experiencesData : [];
                    }

                    if (!empty(old())) {
                        $data = [];
                        foreach (old('qualification_id') as $key => $value) {
                            $data[$key]['qualification_id'] = $value;
                            $data[$key]['university'] = old('university')[$key] ?? null;
                            $data[$key]['duration_from'] = old('duration_from')[$key] ?? null;
                            $data[$key]['duration_to'] = old('duration_to')[$key] ?? null;
                            $data[$key]['from_month'] = old('from_month')[$key] ?? null;
                            $data[$key]['to_month'] = old('to_month')[$key] ?? null;
                            $data[$key]['education_duration_from'] = old('education_duration_from')[$key] ?? null;
                            $data[$key]['education_duration_to'] = old('education_duration_to')[$key] ?? null;
                            $data[$key]['education_from_month'] = old('education_from_month')[$key] ?? null;
                            $data[$key]['education_to_month'] = old('education_to_month')[$key] ?? null;
                        }
                        $educationsData = collect(array_values($data));
                    } else {
                        $educationsData = $this->jobSeekerEducationRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $educationsData = $educationsData->count() > 0 ? $educationsData : [];
                    }
                    if (!empty(old())) {
                        $data = [];
                        foreach (old('certificate_name') as $key => $value) {
                            $data[$key]['certificate_name'] = $value;
                            $data[$key]['certifying_authority'] = old('certifying_authority')[$key] ?? null;
                            $data[$key]['from_month'] = old('from_month')[$key] ?? null;
                            $data[$key]['to_month'] = old('to_month')[$key] ?? null;
                            $data[$key]['from_year'] = old('from_year')[$key] ?? null;
                            $data[$key]['to_year'] = old('to_year')[$key] ?? null;
                        }
                        $licenseData = collect(array_values($data));
                    } else {
                        $licenseData = $this->jobSeekerLicenseRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $licenseData = $licenseData->count() > 0 ? $licenseData : [];
                        // dd($licenseData);
                    }

                    if (!empty(old())) {
                        $data = [];
                        foreach (old('language_id') as $key => $value) {
                            $data[$key]['language_id'] = $value;
                            $data[$key]['speak_id'] = old('speak_id')[$key] ?? null;
                            $data[$key]['read_write_id'] = old('read_write_id')[$key] ?? null;
                        }
                        $language_skillData = collect(array_values($data));
                    } else {
                        $language_skillData = $this->jobSeekerLanguageSkillRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $seekerDetail->id]);
                        $language_skillData = $language_skillData->count() > 0 ? $language_skillData : [];
                    }
                    $skillsData = $seekerDetail->skills ? $seekerDetail->skills->pluck('skill_id')->toArray() : [];

                }

                if ($view->main_title == 'personal') {
                    if (!empty($seekerDetail->dob)) {
                        $dob = FunctionHelper::fromSqlDate($seekerDetail->dob->toDateString(), true, 'd M, Y');
                    }
                }
                break;
            case 'resume_builder.edit':

                //$skillsData = $this->jobSeekerSkillRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $view->seekerDetails->id]);
                //$skillsData = $skillsData->count() > 0 ? $skillsData : [];
                $skillsData = $view->seekerDetails->skills ? $view->seekerDetails->skills->pluck('skill_id')->toArray() : [];

                if (!empty(old())) {
                    if (!empty(old('location_id'))) {
                        $locations = $this->locationRepository->all(['id' => old('location_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                    }
                    if (!empty(old('state_id'))) {
                        $states = $this->stateRepository->all(['id' => old('state_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                    }
                    if (!empty(old('country_id'))) {
                        $countries = $this->countryRepository->all(['id' => old('country_id')], null, null, [], [], ['name' => 'ASC'])->pluck('name', 'id')->all();
                    }
                    if (!empty(old('city_preference'))) {
                        $city_preference = $this->locationRepository->all(['id' => old('city_preference')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                    }
                    // if (!empty(old('category_id'))) {
                    //     $category = $this->categoryRepository->all(['id' => old('category_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
                    // }
                } else {
                    if (!empty($seekerDetail->location)) {
                        $locations = $view->seekerDetails->location->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                    }
                    if (!empty($seekerDetail->state)) {
                        $states = $view->seekerDetails->state->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                    }
                    if (!empty($seekerDetail->country_id)) {
                        $countries = $view->seekerDetails->country->pluck('name', 'id')->all([], null, null, [], [], ['name' => 'ASC']);
                    }
                    if (!empty($seekerDetail->city_preference)) {
                        $city_preference = $view->seekerDetails->location->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                    }
                    // if (!empty($seekerDetail->category)) {
                    //     $category = $seekerDetail->category->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                    // }
                }

                if (!empty(old()) && old('step') == 3) {
                    //dd(old());
                    $data = [];
                    foreach (old('company') as $key => $value) {
                        $data[$key]['company'] = $value;
                        $data[$key]['role'] = old('role')[$key] ?? null;
                        $data[$key]['duration_from'] = old('duration_from')[$key] ?? null;
                        $data[$key]['duration_to'] = old('duration_to')[$key] ?? null;
                        $data[$key]['description'] = old('description')[$key] ?? null;
                    }
                    $experiencesData = collect(array_values($data));
                } else {

                    $experiencesData = $this->jobSeekerExperienceRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $view->seekerDetails->id]);
                    //dd($experiencesData, $view->seekerDetails->id);
                    $experiencesData = $experiencesData->count() > 0 ? $experiencesData : [];
                }

                if (!empty(old()) && old('step') == 4) {
                    $data = [];

                    foreach (old('qualification_id') as $key => $value) {
                        $data[$key]['qualification_id'] = $value;
                        $data[$key]['university'] = old('university')[$key] ?? null;
                        $data[$key]['duration_from'] = old('duration_from')[$key] ?? null;
                        $data[$key]['duration_to'] = old('duration_to')[$key] ?? null;
                        $data[$key]['from_month'] = old('from_month')[$key] ?? null;
                        $data[$key]['to_month'] = old('to_month')[$key] ?? null;
                    }
                    $educationsData = collect(array_values($data));
                } else {
                    $educationsData = $this->jobSeekerEducationRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $view->seekerDetails->id]);
                    $educationsData = $educationsData->count() > 0 ? $educationsData : [];
                }

                if (!empty(old()) && old('step') == 4) {
                    $data = [];
                    foreach (old('certificate_name') as $key => $value) {
                        $data[$key]['certificate_name'] = $value;
                        $data[$key]['certifying_authority'] = old('certifying_authority')[$key] ?? null;
                        $data[$key]['from_month'] = old('from_month')[$key] ?? null;
                        $data[$key]['to_month'] = old('to_month')[$key] ?? null;
                        $data[$key]['from_year'] = old('from_year')[$key] ?? null;
                        $data[$key]['to_year'] = old('to_year')[$key] ?? null;
                    }
                    $licenseData = collect(array_values($data));
                } else {
                    $licenseData = $this->jobSeekerLicenseRepository->all(['user_id' => $view->user->id, 'seeker_detail_id' => $view->seekerDetails->id]);
                    $licenseData = $licenseData->count() > 0 ? $licenseData : [];
                }
                //dd($skillsData);
                break;
        }
        // dd($workTypesids);
        // dd($locations, $states);
        $view->with([
            'gender' => $gender,
            'marital_status' => $marital_status,
            'religion' => $religion,
            'educations' => $educations,
            'languages' => $languages,
            'educationsData' => $educationsData,
            'experiences' => $experiences,
            'salaries' => $salaries,
            'locations' => $locations,
            'city_preference' => $city_preference,
            'experiencesData' => $experiencesData,
            'licenses' => $licenses,
            'licenseData' => $licenseData,
            'skills' => $skills,
            'skillsData' => $skillsData,
            'listEducation' => $listEducation,
            'listExperience' => $listExperience,
            'listLicense' => $listLicense,
            'listSkill' => $listSkill,
            'videodata' => $videodata,
            'listVideo' => $listVideo,
            'seekerDetail' => $seekerDetail,
            'salaryTypes' => $salaryTypes,
            'salary_type_default' => $salary_type_default,
            'states' => $states,
            'countries' => $countries,
            'workTypes' => $workTypes,
            'workTypesids' => $workTypesids,
            'nationality' => $nationality,
            'dob' => $dob,
            'specializations' => $specializations,
            'category' => $category,
            'currency' => $currency,
            'listLanguageSkill' => $listLanguageSkill,
            'language_skillData' => $language_skillData,
            'speaks' => $speaks,
            'read_write' => $read_write,
        ]);
    }
}
