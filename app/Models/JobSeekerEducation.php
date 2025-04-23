<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeekerEducation extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'job_seeker_education';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'qualification_id',
        'university',
        'duration_from',
        'duration_to',
        'education_duration_from',
        'education_duration_to',
        'entitled',
        'location',
        'from_month',
        'to_month',
        'education_from_month',
        'education_to_month',
        'specialization_id',
        'percentile_cgpa',
        'primary_account',
        'seeker_detail_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'qualification_id' => 'integer',
        'university' => 'string',
        'duration_from' => 'integer',
        'duration_to' => 'integer',
        'education_duration_from' => 'integer',
        'education_duration_to' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'location' => 'string',
        'from_month' => 'integer',
        'to_month' => 'integer',
        'education_from_month' => 'integer',
        'education_to_month' => 'integer',
        'specialization_id' => 'integer',
        'percentile_cgpa' => 'double',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'qualification_id' => 'required',
        'university' => 'required'
    ];

    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function getEducationAttribute()
    {
        $education = [
            'qualification' => $this->qualification->title,
            'university' => $this->university ?? null,
            'location' => $this->location ?? null,
            'duration' => $this->education_duration_from . ' - ' . $this->education_duration_to ?? null
        ];
        return implode(', ', array_filter($education));
    }
}
