<?php

namespace App\Models;

use App\Helpers\FunctionHelper;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeekerDetail extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;
    use DocumentRelationship;

    public $table = 'job_seeker_detail';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at', 'dob', 'licence_validity'];

    public $fillable = [
        'user_id',
        'location_id',
        'description',
        'website',
        'cover_title',
        'cover_desc',
        'gender',
        'title',
        'salary',
        'salary_type_id',
        'total_experience',
        'state_id',
        'area',
        'parent_name',
        'permanent_address',
        'dob',
        'language_known',
        'nationality',
        'indentity_no',
        'country_id',
        'licence_no',
        'licence_validity',
        'specialization_id',
        'professional_manner',
        'place_of_birth',
        'marital_status',
        'Religion',
        'currently_staying_in',
        'visa_status',
        'Relocation',
        'is_public_profile',
        'facebook_url',
        'instagram_url',
        'blog_url',
        'linkedin_url',
        'Job_preference',
        'city_preference',
        'category_id',
        'current_salary',
        'expected_salary',
        'is_fresher',
        'current_position',
        'current_company',
        'training_name',
        'attended_at_company',
        'year',
        'personal_statement',
        'currency',
        'age',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'who_are_you',
        'i_am_a',
        'searching_for',
        'primary_account',
        'step',
        'phone',
        'social_links',
        'my_core_competencies',
        'resume_summary',
        'experience_summary',
        'mobile_number',
        'profile_summary',
        'preferred_position',
        'instruction_cv_writing',
        'linkedin_link'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'location_id' => 'integer',
        'description' => 'string',
        'website' => 'string',
        'cover_title' => 'string',
        'cover_desc' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'total_experience' => 'integer',
        'parent_name' => 'string',
        'permanent_address' => 'string',
        'dob' => 'date',
        'language_known' => 'string',
        'nationality' => 'integer',
        'indentity_no' => 'string',
        'licence_no' => 'string',
        'licence_validity' => 'date',
        'professional_manner' => 'string',
        'place_of_birth' => 'string',
        'city_preference' => 'json',
        'year' => 'integer',
        'age' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'website' => 'nullable|url',
        'facebook_url' => 'nullable|url',
        'instagram_url' => 'nullable|url',
        'blog_url' => 'nullable|url',
        'linkedin_url' => 'nullable|url'
    ];

    public static $messages = [
        'website.url' => 'Please enter valid website address. Ex: https://www.google.com',
        'facebook_url.url' => 'Please enter valid facebook profile url',
        'instagram_url.url' => 'Please enter valid instagram profile url',
        'blog_url.url' => 'Please enter valid blog url',
        'linkedin_url.url' => 'Please enter valid linkedin profile url'
    ];

    // public function city_preference()
    // {
    //     return $this->belongsTo(Location::class, 'city_preference', 'id');
    // }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
    public function workType()
    {
        return $this->belongsToMany(JobSeekerWorkType::class, 'job_seeker_work_type', 'job_seeker_detail_id', 'work_type_id');
    }
    public function workTypes()
    {
        return $this->hasMany(JobSeekerWorkType::class, 'job_seeker_detail_id', 'id');
    }

    public function getAddressAttribute()
    {
        $address = [
            'area' => $this->area,
            'district' => $this->location->title ?? null,
            'state' => $this->state->title ?? null,
            'country' => $this->country->name ?? null,
        ];
        return implode(', ', array_filter($address));
    }

    public function getCityPreferAttribute()
    {
        $city_preference_title = [];
        if (!empty($this->city_preference)) {
            foreach ($this->city_preference as $key => $value) {
                $city_preference_title[] = Location::find($value)->title;
            }
        }
        return implode(', ', $city_preference_title);
    }

    public function getShortAddressAttribute()
    {
        $address = [
            'district' => $this->location->title ?? null,
            'state' => $this->state->title ?? null];
        return implode(', ', array_filter($address));
    }



    public function getImage($width = '', $height = '')
    {
        $documentRepo = FunctionHelper::getRepositoryByModule('documents');
        $documentRepo->setDisk('user');
        $endpoint = $documentRepo->getEndpoint();

        if (isset($this->profilePic) && $this->profilePic->count() > 0) {
            $src = $this->profilePic->presigned_url;

            $file = $documentRepo->getFile($this->profilePic->file_path);

            $src = \Illuminate\Support\Str::base64ImageSrc($this->profilePic->mime_type, $file);
            $imageTag = '<img src="' . $src . '" class="mr-2 user-30 img-fluid" width="' . $width . '" height="' . $height . '" style="border-radius: 10px;">';
            return $imageTag;
        }
        return null;
    }

    public function skills()
    {
        return $this->hasMany(JobSeekerSkill::class, 'seeker_detail_id', 'id');
    }

    public function prepareInput($item)
    {
        $item->full_name = !empty($item->first_name) ? $item->first_name : '';
        $item->job_title = !empty($item->title) ? $item->title : '';

        // $item->gender = !empty($item->seekerDetail) ? $item->seekerDetail->gender : '';
        $item->address = !empty($item) ? $item->address : '';

        $item->description = !empty($item) ? $item->description : '';

        $item->logo = !empty($item) ? $item->getImage('110px', '110px') : '';
        // dd($item);
        return $item;
    }

    public function seekerEducation()
    {
        return $this->hasMany(JobSeekerEducation::class, 'seeker_detail_id', 'id')->where('qualification_id', '!=', null);
    }

    public function seekerExperience()
    {
        return $this->hasMany(JobSeekerExperience::class, 'seeker_detail_id', 'id');
    }

    public function seekerLicense()
    {
        return $this->hasMany(JobSeekerLicense::class, 'seeker_detail_id', 'id');
    }

    public function seekerSkill()
    {
        return $this->hasMany(JobSeekerSkill::class, 'seeker_detail_id', 'id')->where('skill_id', '!=', null);
    }
}
