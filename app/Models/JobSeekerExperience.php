<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeekerExperience extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'job_seeker_experience';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'company',
        'duration_from',
        'duration_to',
        'role',
        'description',
        'location',
        'reference_name',
        'reference_phone_number',
        'reference_position',
        'years_known',
        'from_month',
        'to_month',
        'seeker_detail_id',
        'currently_working'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'company' => 'string',
        'duration_from' => 'integer',
        'from_month' => 'integer',
        'to_month' => 'integer',
        'duration_to' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'role' => 'string',
        'location' => 'string',
        'currently_working' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'company' => 'required',
        'reference_name' => 'required'
    ];

    public static $messages = [
        'company.required' => 'Company name fields is required.'
    ];

    public function getEducationAttribute()
    {
        $education = [
            'qualification' => $this->qualification->title,
            'university' => $this->university ?? null,
            'location' => $this->location ?? null,
            'duration' => $this->duration_from . ' - ' . $this->duration_to ?? null
        ];
        return implode(', ', array_filter($education));
    }
}
