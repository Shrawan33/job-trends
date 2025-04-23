<?php
namespace App\Traits;

use App\Helpers\FunctionHelper;
use App\Models\Qualification;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Salary;
use App\Models\WorkType;
// use App\Models\Specialization;
use Laravel\Scout\Searchable;

trait Jobsearch
{
    use Searchable;

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        $subdomain = env('SUBDOMAIN');
        if($subdomain != "")
        {
            $jobs =  'jobs-'.$subdomain;
        }
        else
        {
            $jobs =  'jobs';
        }
        return $jobs;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only(['id', 'title', 'description', 'slug', 'approval_status', 'approval_status_reason','job_type_id','specialization_id','is_urgent','is_featured']);

        $array['is_featured'] = $array['is_featured'] ? 1 : 0;

        //$array['description'] = nl2br($array['description']);
        //$array['description'] = "Test job Row1 </br> Test job row 2";
        // url to job detail page

        $array['job_link'] = route('job-detail', $this->slug);

        //jobtypes
        // $array['job_type_id'] = $this->job_type_id ?? null;


        // address
        $array['address'] = $this->address ?? null;
        $array['region'] = $this->state->title ?? null;
        $array['province'] = $this->location->title ?? null;
        $array['suburb'] = $this->area->title ?? null;

        $array['state_id'] = $this->state->id ?? null;
        $array['location_id'] = $this->location->id ?? null;

        // child categories
        $array['category'] = $this->category->title ?? null;
        $array['category_id'] = $this->category->id ?? null;
        $array['category_slug'] = $this->category->slug ?? null;

        // work types
        //$array['work_type'] = $this->jobType->title ?? null;
        //$array['work_type_id'] = $this->jobType->id ?? null;

        // experience
        $array['experience'] = $this->experience->title ?? null;
        $array['experience_id'] = $this->experience->id ?? null;

        // //specialization
        // $array['specialization'] = $this->specialization->name ?? null;
        // $array['specialization_id'] = $this->specialization->id ?? null;

        // skills
        $array['skills'] = $this->coreSkills->count() > 0 ? implode(', ', $this->coreSkills->pluck('title')->all()) : [];
        $array['skill_ids'] = $this->coreSkills->count() > 0 ? implode(', ', $this->coreSkills->pluck('id')->all()) : [];

        // qualifications
        $array['qualifications'] = $this->coreQualifications->count() > 0 ? $this->coreQualifications->pluck('title')->all() : [];
        $array['qualification_ids'] = $this->coreQualifications->count() > 0 ? $this->coreQualifications->pluck('id')->all() : [];

        // certifications
        $array['certifications'] = $this->coreCertifications->count() > 0 ? $this->coreCertifications->pluck('title')->all() : [];

        $array['work_types'] = $this->coreWorktypes->count() > 0 ? $this->coreWorktypes->pluck('title')->all() : [];

        $array['work_type_ids'] = $this->coreWorktypes->count() > 0 ? $this->coreWorktypes->pluck('id')->all() : [];


        // salary type
        $array['salary_type'] = config("constants.salary_type.data.{$this->salary_type_id}", null);
        $array['salary_type_id'] = $this->salary_type_id;
        $array['salary_id'] = $this->salary_id;
        // salary range
        $array['salary'] = !empty($this->salary) ? ((FunctionHelper::formatPrice($this->salary->start) ?? null) . ' - ' . (FunctionHelper::formatPrice($this->salary->end) ?? null)) : null;
        //$array['salary'] = !empty($this->salary) ? (intval($this->salary) ?? 0) : 0;
        //$array['salary_to'] = !empty($this->salary_to) ? (intval($this->salary_to) ?? 0) : 0;
        //$array['salary'] = 0;
        // posted on
        $created_at = FunctionHelper::fromSqlDateTime($this->created_at, false);
        $array['created_at'] = $created_at ? $created_at->getTimestamp() : null;
        $array['posted_on'] = $this->created_at ? $this->created_at->diffForHumans() : null;

        // company info
        $array['employer'] = $this->createdByUser->company_name ?? null;
        $array['employer_link'] = route('job-detail.employer.show', $this->createdByUser->slug ?? 0);

        // company logo
        $defaultLogo = asset('images/home_logo.svg');
        $array['logo'] = $defaultLogo;
        $array['presigned_logo'] = $defaultLogo;
        if (!empty($this->createdByUser->usersProfile) && !empty($this->createdByUser->usersProfile->profilePic)) {
            // it gives actual url(not presigned)
            if (@getimagesize($this->createdByUser->usersProfile->profilePic->url)) {
                $array['logo'] = $this->createdByUser->usersProfile->profilePic->url;
            } else {
                $array['logo'] = $defaultLogo;
            }

            if (@getimagesize($this->createdByUser->usersProfile->profilePic->presigned_url)) {
                $array['presigned_logo'] = $this->createdByUser->usersProfile->profilePic->presigned_url;
            } else {
                $array['presigned_logo'] = $defaultLogo;
            }

            // it gives actual presigned_url
         //   $array['presigned_logo'] = $this->createdByUser->usersProfile->profilePic->presigned_url ?? $defaultLogo;
        }

        //$array['is_hide'] = $this->is_show; // to hide the company detail if is_show == 1 then need to hide company info else display

        //$array['urgency'] = $this->urgency ?? null;
        //$array['application_handling'] = FunctionHelper::fromSqlDate($this->application_handling->toDateString(), true, true) ?? '';
        $array['images'] = $this->images ?? null;
        $array['description'] = $this->description ?? null;
        $array['other_recuirements'] = $this->other_recuirements ?? null;
        //$array['no_of_job_hire'] = $this->no_of_job_hire ?? null;
        $array['expiration_date'] = FunctionHelper::fromSqlDate($this->expiration_date->toDateString(), true, true) ?? '';
        //$array['views'] = $this->views ?? null;
        //$array['covid_requirements'] = $this->covid_requirements ?? null;
        //$array['additional_compensations'] = $this->additional_compensations ?? null;
        //$array['additional_benefits'] = $this->additional_benefits ?? null;
        //$array['employer_phone_number'] = $this->employer_phone_number ?? null;
        $array['type_of_work'] = $this->type_of_work ?? null;
        //$array['nationality'] = $this->nationality ?? null;
        $array['is_active'] = $this->is_active;

        //file_put_contents(public_path('meilisearch_data.txt'),json_encode($array));

        return $array;
    }

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->id;
    }

    public function shouldBeSearchable()
    {
       // return !empty($this->createdByUser);
       return true;
    }

    /**
     * Get the key name used to index the model.
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'id';
    }

    public function coreQualifications()
    {
        return $this->belongsToMany(Qualification::class, 'employer_job_qualifications', 'employer_job_id', 'qualification_id');
    }

    public function coreSkills()
    {
        return $this->belongsToMany(Skill::class, 'employer_jobs_skill', 'employer_job_id', 'skill_id');
    }

    public function coreCertifications()
    {
        return $this->belongsToMany(Certification::class, 'employer_job_certifications', 'employer_job_id', 'certification_id');
    }

    public function coreWorktypes()
    {
        return $this->belongsToMany(WorkType::class, 'employer_jobs_work_type', 'employer_job_id', 'work_type_id');
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
}
