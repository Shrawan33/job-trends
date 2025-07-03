<?php

namespace App\Models;

use App\Scopes\ActiveEmployerScope;
use App\Traits\ApprovalStatus;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\Jobsearch;
use App\Traits\ModelState;
use App\Traits\NextNumber;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;


/**
 * Class EmployerJob
 * @package App\Models
 * @version January 22, 2021, 11:24 am UTC
 *
 * @property bigIncrements $id
 * @property string $title
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property string $description
 * @property string $company_name
 * @property string $company_profile
 * @property string $work_type_id
 * @property string $contact_name
 * @property string $phone_number
 * @property string $website
 * @property string $skill_id
 * @property string $location_id
 * @property string $experience_id
 * @property string $salary_id
 * @property string $interview_type_id
 * @property unsignedBigInteger $updated_by
 * @property unsignedBigInteger $created_by
 * @property tinyInteger $is_deleted
 * @property string $deleted_at
 */
class EmployerJob extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use NextNumber;
    use DocumentRelationship;
    use Jobsearch;
    use ApprovalStatus;
    use Notifiable;

    public $table = 'employer_jobs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'title',
        'category_id',
        'subcategory_id',
        'description',
        'company_name',
        'company_profile',
        'contact_name',
        'phone_number',
        'website',
        'location_id',
        'experience_id',
        'salary_id',
        'interview_type_id',
        'job_number',
        'certification_id',
        'is_featured',
        'salary_type_id',
        'updated_by',
        'created_by',
        'is_deleted',
        'deleted_at',
        'status',
        'state_id',
        'area',
        'slug',
        'expiration_date',
        'other_recuirements',
        'tc_checkbox',
        'is_urgent',
        'approval_status',
        'approval_status_reason',
        'job_type_id',
        'specialization_id',
        'meta_title',
        'meta_description',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'category_id' => 'integer',
        'subcategory_id' => 'integer',
        'description' => 'string',
        'other_recuirements' => 'string',
        'company_name' => 'string',
        'company_profile' => 'string',
        'contact_name' => 'string',
        'phone_number' => 'string',
        'website' => 'string',
        'location_id' => 'integer',
        'state_id' => 'integer',
        'area' => 'string',
        'experience_id' => 'integer',
        'salary_id' => 'integer',
        'interview_type_id' => 'integer',
        'job_number' => 'string',
        'certification_id' => 'integer',
        'is_featured' => 'boolean',
        'salary_type_id' => 'integer',
        'status' => 'integer',
        'slug' => 'string',
        'expiration_date' => 'date',
        'meta_title' => 'string',
        'meta_description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'state_id' => 'required',
        'location_id' => 'required',
        'tc_checkbox' => 'required',
        'expiration_date' => 'required'
    ];

    public static $messages = [
        'title.required' => 'Title Field is Required.',
        'description.required' => 'Description Field is Required.',
        'category_id.required' => 'Category Field is Required.',
        'state_id.required' => 'State Field is Required.',
        'location_id.required' => 'District Field is Required.',
        'expiration_date.required' => 'Expiration Date is Required'
    ];

    // /**
    //  * The "booting" method of the model.
    //  *
    //  * @return void
    //  */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new ActiveEmployerScope);
    // }

    // public function jobType()
    // {
    //     return $this->belongsTo(WorkType::class, 'work_type_id', 'id');
    // }
    public function jobTypes()
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }
    public function workType()
    {
        return $this->belongsToMany(EmployerJobWorkType::class, 'employer_jobs_work_type', 'employer_job_id', 'work_type_id');
    }
    public function workTypes()
    {
        return $this->hasMany(EmployerJobWorkType::class, 'employer_job_id', 'id');
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

    public function skill()
    {
        return $this->belongsToMany(EmployerJobSkill::class, 'employer_jobs_skill', 'employer_job_id', 'skill_id');
    }

    public function skills()
    {
        return $this->hasMany(EmployerJobSkill::class, 'employer_job_id', 'id');
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
    public function certification()
    {
        return $this->belongsToMany(EmployerJobCertification::class, 'employer_job_certifications', 'employer_job_id', 'certification_id');
    }

    public function certifications()
    {
        return $this->hasMany(EmployerJobCertification::class, 'employer_job_id', 'id');
    }

    public function qualification()
    {
        return $this->belongsToMany(EmployerJobQualification::class, 'employer_job_qualifications', 'employer_job_id', 'qualification_id');
    }

    public function qualifications()
    {
        return $this->hasMany(EmployerJobQualification::class, 'employer_job_id', 'id');
    }

    public function creditTransactions()
    {
        return $this->morphMany(UserPackageTransaction::class, 'transactable');
    }

    public function appliedJob()
    {
        $relation = $this->belongsTo(ApplyJob::class, 'id', 'employer_job_id');
        if (auth()->user()) {
            $relation->where('user_id', '=', auth()->user()->id);
            $relation->where('user_id', '!=', null);
        }
        return $relation;
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function applyJob()
    {
        return $this->hasMany(ApplyJob::class, 'employer_job_id', 'id')->where('user_id', '!=', null);
    }

    public function applyJobWithoutHiddenProfile()
    {
        return $this->hasMany(ApplyJob::class, 'employer_job_id', 'id')->where('user_id', '!=', null);
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class, 'experience_id', 'id');
    }

    public function report()
    {
        $relation = $this->morphOne(Report::class, 'reported');
        if (!empty(auth()->user())) {
            $relation->where('reporter_id', auth()->user()->id);
        }
        return $relation;
    }

    public function scopeWithEmployer($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'employer_jobs.created_by');
            $query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        });
    }

    public function scopeWithJobtype($query)
    {
        return $query->leftJoin('job_types', function ($query) {
            $query->on('job_types.id', '=', 'employer_jobs.job_type_id');
        });
    }
    public function scopeWithspecialization($query)
    {
        return $query->leftJoin('specializations', function ($query) {
            $query->on('specializations.id', '=', 'employer_jobs.specialization_id');
        });
    }

    public function scopewithQualification($query)
    {
        return $query->leftJoin('employer_job_qualifications', function ($query) {
            $query->on('employer_job_qualifications.employer_job_id', '=', 'employer_jobs.id');

            $query->whereNull('employer_job_qualifications.deleted_at')->where('employer_job_qualifications.is_deleted', 0);
        });
    }

    public function scopewithWorkType($query)
    {
        return $query->leftJoin('employer_jobs_work_type', function ($query) {
            $query->on('employer_jobs_work_type.employer_job_id', '=', 'employer_jobs.id');

            $query->whereNull('employer_jobs_work_type.deleted_at')->where('employer_jobs_work_type.is_deleted', 0);
        });
    }

    public function scopewithCategory($query)
    {
        return $query->leftJoin('categories', function ($query) {
            $query->on('categories.id', '=', 'employer_jobs.category_id');

            $query->whereNull('categories.deleted_at')->where('categories.is_deleted', 0);
        });
    }

    public function scopewithsearchElement($query)
    {
        return $query->leftJoin('employer_jobs_skill', function ($query) {
            $query->on('employer_jobs_skill.employer_job_id', '=', 'employer_jobs.id');
            $query->whereNull('employer_jobs_skill.deleted_at')->where('employer_jobs_skill.is_deleted', 0);
        })
        ->leftJoin('skills', function ($query) {
            $query->on('skills.id', '=', 'employer_jobs_skill.skill_id');
            $query->whereNull('skills.deleted_at')->where('skills.is_deleted', 0);
        });
    }

    public function favouritJob()
    {
        $relation = $this->belongsTo(FavoriteJob::class, 'id', 'employer_job_id');
        if (auth()->user()) {
            $relation->where('user_id', '=', auth()->user()->id);
        }
        return $relation;
    }

    public function relatedJobs()
    {
        // return $this->hasMany(EmployerJob::class, 'category_id', 'category_id')->whereRaw('FIND_IN_SET(title, "' . str_replace(' ', ',', $this->title) . '")');

        return $this->hasMany(EmployerJob::class, 'category_id', 'category_id')->where('title', 'LIKE', "%{$this->title}%")->whereHas('createdByUserWithActivePackage');
    }

    public function questionnaire()
    {
        return $this->hasMany(Questionnaire::class, 'employer_job_id');
    }

    public function getAddressAttribute()
    {
        $address = [
            'district' => $this->location->title ?? null,
            'state' => $this->state->title ?? null
        ];
        return implode(', ', array_filter($address));
    }

    public function getActiveJobsCountAttribute()
    {
        $date = date('Y-m-d');
        $active_count = $this->model->where('expiration_date', '>', $date)->where('deleted_at', null)->count();
        dd($active_count);
    }

    /**
     * setQuestionnaireSession function
     *
     * @return void
     */
    public static function setQuestionnaireSession($id, $data = []) : Collection
    {
        Session::put("job.$id.questionnaire", $data);
        return collect($data);
    }

    /**
     * getQuestionnaireSession function
     *
     * @return void
     */
    public static function getQuestionnaireSession($id) : Collection
    {
        $data = [];
        if (Session::has("job.$id.questionnaire")) {
            $data = Session::get("job.$id.questionnaire");
        }
        return collect($data);
    }

    public function transaction()
    {
        return $this->morphOne(UserPackageTransaction::class, 'transactable')->where('credit_type', 'job_posts');
    }

    public function isTransactionCompleted()
    {
        return !empty($this->transaction->userPackage) ?: false;
    }

    public function interviewSchedule()
    {
        return $this->hasMany(InterviewSchedule::class, 'employer_job_id', 'id')->where('user_id', '!=', null);
    }
}
