<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\NextNumber;
use App\Traits\Sms;
use App\Traits\ToSqlDate;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use CreatedByUpdatedBy;
    use CanResetPassword;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use Sms;
    use NextNumber;
    use DocumentRelationship;
    use Impersonate;

    protected $guard_name = 'web';
    protected $appends = ['full_name'];
    public $next_number_fields = ['user_code'];
    public $except_datetime = ['email_verified_at', 'mobile_verified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone_number', 'tc_checkbox', 'company_name',
        'created_by',
        'updated_by',
        'email_verified_at',
        'is_deleted',
        'user_code',
        'hide_profile',
        'provider', 'provider_id', 'mobile_verified_at',
        'featured',
        'last_login',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number' => 'string',
        'company_name' => 'text',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'mobile_verified_at' => 'datetime',
        'featured' => 'boolean',
        'last_login' => 'datetime'
    ];

    public static $rules = [
        'tc_checkbox' => ['required'],
        'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone_number,NULL,id,deleted_at,NULL'],
        'email' => ['required', 'string', 'email', 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
        'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', 'confirmed'],
    ];

    public function usersProfile()
    {
        return $this->belongsTo(UserProfile::class, 'id', 'user_id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userPackages()
    {
        return $this->hasMany(UserPackage::class, 'user_id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAvailablePackages()
    {
        return $this->hasMany(UserPackage::class, 'user_id')->where('is_active', null);
    }

    public function userPastPackages()
    {
        return $this->hasMany(UserPackage::class, 'user_id')->where('is_active', 0)->orWhere('is_active', 2);
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activeUserPackage()
    {
        return $this->hasOne(UserPackage::class, 'user_id')->where('is_active', 1);
    }

    public function isAssignedByAccount()
    {
        return $this->hasOne(AssignEmployer::class, 'employer_id')->where('account_manager_id', '!=', null);
    }

    public function meeting()
    {
        return $this->belongsTo(ZoomMeeting::class, 'id', 'jobseeker_id');
    }

    public function seekerDetail()
    {
        return $this->belongsTo(JobSeekerDetail::class, 'id', 'user_id')->where('primary_account', 1);
    }
    public function worktype()
    {
        return $this->hasOne(JobSeekerDetail::class, 'user_id');
    }
    public function seekerDisc()
    {
        return $this->hasMany(JobSeekerDisc::class, 'user_id', 'id');
    }

    public function seekerEducation()
    {
        return $this->hasMany(JobSeekerEducation::class, 'user_id', 'id')->where('qualification_id', '!=', null);
    }

    public function seekerExperience()
    {
        return $this->hasMany(JobSeekerExperience::class, 'user_id', 'id');
    }

    public function seekerLicense()
    {
        return $this->hasMany(JobSeekerLicense::class, 'user_id', 'id');
    }

    public function seekerSkill()
    {
        return $this->hasMany(JobSeekerSkill::class, 'user_id', 'id')->where('skill_id', '!=', null);
    }

    public function seekerLanguage()
    {
        return $this->hasMany(JobSeekerLanguage::class, 'user_id', 'id');
    }

    public function seekerVideo()
    {
        return $this->hasMany(JobSeekerVideo::class, 'user_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function favourite()
    {
        return $this->belongsTo(FavoriteCandidate::class, 'id', 'user_id')->where('created_by', auth()->user()->id);
    }

    public function report()
    {
        return $this->morphOne(Report::class, 'reported');

        // if (!empty(auth()->user())) {
        //     $relation->where('reporter_id', auth()->user()->id);
        // }

        // return $relation;
    }

    public function appliedJobs()
    {
        return $this->hasManyThrough(EmployerJob::class, ApplyJob::class, 'user_id', 'id', 'id', 'employer_job_id')->where('employer_jobs.created_by', auth()->user()->id);
    }

    public function creditTransactions()
    {
        return $this->morphMany(UserPackageTransaction::class, 'transactable');
    }

    // it is used to get list of employers[user_id] which are unlocked current jobseeker[transactable_id]
    public function profileUnlocked()
    {
        return $this->hasOne(UserPackageTransaction::class, 'transactable_id')->where('transactable_type', self::class);
    }

    public function profileLocked()
    {
        return $this->hasOne(UserPackageTransaction::class, 'transactable_type', self::class)->where('transactable_id', '!=', $this->id);
    }

    // public function scopeIsUnlocked($builder, $user_id = 0)
    // {
    //     return $builder->profileUnlocked();
    // }

    /**
     * Scope a query to only include staff users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMembers($query, $includeOnly = [], $excludeRoles = [])
    {
        return $query->whereHas('roles', function ($role) use ($includeOnly, $excludeRoles) {
            if (!empty($includeOnly)) {
                $role->whereIn('name', $includeOnly);
            }
            if (!empty($excludeRoles)) {
                $role->whereNotIn('name', $excludeRoles);
            }
        });
    }

    public function scopeWithRole($query)
    {
        return $query->leftJoin('model_has_roles', function ($query) {
            $query->on('users.id', '=', 'model_has_roles.model_id');
        });
    }

    // public function scopeWithPackage($query,$is_paid)
    // {
    //     $status = '';
    //     if($is_paid == 1){
    //         $query->
    //     }else{

    //     }
    //     return $status;

    // }

    public function scopeWithSeekerFilter($query)
    {
        return $query->join('job_seeker_detail', function ($query) {
            $query->on('users.id', '=', 'job_seeker_detail.user_id');
        })
        ->leftJoin('job_seeker_education', function ($query) {
            $query->on('users.id', '=', 'job_seeker_education.user_id');
        })
        ->leftJoin('job_seeker_experience', function ($query) {
            $query->on('users.id', '=', 'job_seeker_experience.user_id');
        })
        ->leftJoin('job_seeker_skill', function ($query) {
            $query->on('users.id', '=', 'job_seeker_skill.user_id');
        })
        ->leftJoin('job_seeker_work_type', function ($query) {
            $query->on('job_seeker_detail.id', '=', 'job_seeker_work_type.job_seeker_detail_id');
        });
    }

    public function scopeWithEmployerDetail($query)
    {
        return $query->leftJoin('users_profile', function ($query) {
            $query->on('users.id', '=', 'users_profile.user_id');
        });
    }
    public function scopeWithEmployer($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'employer_jobs.created_by');
            $query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        });
    }
    public function getName()
    {
        return $this->getFullNameAttribute();
    }

    public function isVerified()
    {
        $sms_access = Configuration::getSessionConfigurationName(['general'], null, 'sms_access');
        if ($sms_access) {
            return $this->isEmailVerified() && $this->isPhoneVerified();
        } else {
            return $this->isEmailVerified();
        }

    }

    public function isEmailVerified()
    {
        return !empty($this->email_verified_at);
    }

    public function isPhoneVerified()
    {
        return !empty($this->mobile_verified_at);
    }

    public function prepareInput($item)
    {
        $item->full_name = !empty($item->full_name) ? $item->full_name : '';
        $item->job_title = !empty($item->seekerDetail) ? $item->seekerDetail->title : '';

        // $item->gender = !empty($item->seekerDetail) ? $item->seekerDetail->gender : '';
        $item->address = !empty($item->seekerDetail) ? $item->seekerDetail->address : '';

        $item->description = !empty($item->seekerDetail) ? $item->seekerDetail->description : '';

        $item->logo = !empty($item->seekerDetail) ? $item->seekerDetail->getImage('110px', '110px') : '';
        // dd($item);
        return $item;
    }

    public function currentEmployer($experiences)
    {
        $currentEmployer = [] ;
        $max = $experiences->max('duration_to');
        $currentEmployer = $experiences->where('duration_to', $max)->first();

        $role = $location = $company = '' ;
        if (isset($currentEmployer->role)) {
            $role = $currentEmployer->role . ', ';
        }

        if (isset($currentEmployer->company)) {
            $company = $currentEmployer->company . ', ';
        }

        if (isset($currentEmployer->location)) {
            $location = $currentEmployer->location;
        }
        return $company . $role . $location;
    }

    public function isProfileComplete()
    {
        $incompleteSections = [];

        // Define all sections dynamically
        $profileSections = [
            'personal_details',
            'job_application',
            'contact_information',
            'professional_information',
            'education',
            'experience',
            'skill',
            'language',
            'personal_statement'
        ];

        // Dynamic total fields count
        $total_fields = count($profileSections);
        $single_percentage_value = 100 / $total_fields;
        $total_percentage_count = 0;

        /** Personal Details */
        if ($this->seekerDetail) {
            $personal_details_field_check = ['gender', 'dob', 'marital_status', 'Religion', 'currently_staying_in'];
            $nullFields = collect($this->seekerDetail->only($personal_details_field_check))->filter(fn($value) => is_null($value) || empty($value));
            $personal_details = $nullFields->isEmpty();
        }

        if (!$personal_details) {
            $incompleteSections[] = 'personal_details';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Job Application */
        if ($this->seekerDetail) {
            $job_application_field_check = ['professional_manner', 'my_core_competencies', 'current_position', 'current_company', 'category_id', 'preferred_position', 'city_preference'];
            $nullFields = collect($this->seekerDetail->only($job_application_field_check))->filter(fn($value) => is_null($value) || empty($value));
            $job_application = $nullFields->isEmpty();
        }

        if (!$job_application) {
            $incompleteSections[] = 'job_application';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Contact Information */
        if ($this->seekerDetail) {
            $contact_information_field_check = ['country_id', 'state_id', 'location_id', 'permanent_address', 'nationality'];
            $nullFields = collect($this->seekerDetail->only($contact_information_field_check))->filter(fn($value) => is_null($value) || empty($value));
            $contact_information = $nullFields->isEmpty();
        }

        if (!$contact_information) {
            $incompleteSections[] = 'contact_information';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Professional Information */
        $work_types = !empty($this->seekerDetail->workTypes);
        $title = !empty($this->seekerDetail->title);
        $resume = !empty($this->seekerDetail->documents);
        $cover = !empty($this->seekerDetail->coverDocuments);

        $professional_information = $work_types && $title && $resume && $cover;
        if (!$professional_information) {
            $incompleteSections[] = 'professional_information';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Education */
        $education = !empty($this->seekerDetail->seekerEducation);
        if (!$education) {
            $incompleteSections[] = 'education';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Experience */
        $experience = !empty($this->seekerDetail->seekerExperience);
        if (!$experience) {
            $incompleteSections[] = 'experience';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Skills */
        $skill = !empty($this->seekerDetail->seekerSkill);
        if (!$skill) {
            $incompleteSections[] = 'skill';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Language */
        $language = !empty($this->seekerLanguage);
        if (!$language) {
            $incompleteSections[] = 'language';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        /** Personal Statement */
        $personal_statement = !empty($this->seekerDetail->personal_statement);
        if (!$personal_statement) {
            $incompleteSections[] = 'personal_statement';
        } else {
            $total_percentage_count += $single_percentage_value;
        }

        // Prepare final response
        $profile['incompleteSections'] = empty($incompleteSections) ? true : implode(', ', $incompleteSections);
        $profile['total_percentage_count'] = round($total_percentage_count);

        return $profile;
    }


    public function payment()
    {
        return $this->hasOne(Payment::class, 'created_by', 'id')->where('entity_type', 1)->where('transaction_status', 1);
    }

    public function isPaymentCompleted()
    {
        return !empty($this->payment) ?: false;
    }
    public function candidateNote()
    {
        return $this->hasMany(CandidateNote::class, 'candidate_id', 'id')->orderBy('created_at', 'DESC');

    }
    public function isEmployer()
    {
        return $this->role === 'employer';
    }

    public function review()
    {
        return $this->hasMany(UserReview::class, 'review_to_id', 'id')->where('review_type', 1);

    }
    public function userBadge() {
        return $this->hasMany(UserReview::class, 'review_to_id', 'id')->where('review_type', 2)->groupBy('review_to_id');
    }

}
