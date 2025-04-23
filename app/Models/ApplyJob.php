<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyJob extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'applied_jobs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'employer_job_id',
        'is_apply',
        'created_by',
        'updated_by',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'employer_job_id' => 'integer',
        'is_apply' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];
    public static $messages = [
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function userWithoutHiddenProfile()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('hide_profile', false);
    }

    public function employerJob()
    {
        return $this->belongsTo(EmployerJob::class, 'employer_job_id', 'id');
    }

    public function questionnaires()
    {
        return $this->hasMany(AppliedJobQuestionnaire::class, 'applied_job_id', 'id');
    }

    public function scopeWithJob($query) // used in ApplyJob only [jobseeker]
    {
        $query->join('employer_jobs as empjobs', function ($query) {
            $query->on('empjobs.id', '=', 'applied_jobs.employer_job_id');
            $query->whereNull('empjobs.deleted_at')->where('empjobs.is_deleted', 0);
        });
        $query->activeCreatedBy('empjobs', false);
        return $query;
    }

    public function scopeWithJobSeeker($query) // used in Application Tracking [employer]
    {
        return $query->join('users', function ($query) {
            $query->on('users.id', '=', 'applied_jobs.user_id');
            $query->whereNull('users.deleted_at')->where('users.is_deleted', 0);
            $query->where('users.hide_profile', false);
        })
        ->join('job_seeker_detail', function ($query) {
            $query->on('job_seeker_detail.user_id', '=', 'users.id');
            $query->whereNull('job_seeker_detail.deleted_at')->where('job_seeker_detail.is_deleted', 0);
            $query->where('primary_account', 1);
        });
    }

    public function scopeWithEmployerJob($query)
    {
        return $query->leftJoin('employer_jobs', function ($query) {
            $query->on('employer_jobs.id', '=', 'applied_jobs.employer_job_id');
            $query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        });
    }
}
