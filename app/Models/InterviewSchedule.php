<?php
namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewSchedule extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'interview_schedule';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'employer_job_id',
        'users',
        'title',
        'description',
        'interview_link',
        'datetime',
        'created_by',
        'updated_by'
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
        'users' => 'string',
        'title' => 'string',
        'description' => 'string',
        'interview_link' => 'string',
        'datetime' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'interview_link' => 'required',
        // 'datetime' => 'required'
        'date' => 'required',
        'time' => 'required',

    ];
    public static $messages = [
		'title.required' => 'Title Field is Required.',
        'description.required' => 'Description Field is Required.',
        'interview_link.required' => 'Interview Link Field is Required.',
        // 'datetime.required' => 'Datetime Field is Required.'
    ];

    public function user() // candidate
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function employerJob() // job
    {
        return $this->belongsTo(EmployerJob::class, 'employer_job_id', 'id');
    }

    public function questionnaires()
    {
        return $this->hasMany(AppliedJobQuestionnaire::class, 'applied_job_id', 'id');
    }

    // public function option()
    // {
    //     return $this->hasManyThrough(QuestionnaireOption::class, AppliedJobQuestionnaire::class, 'applied_job_id', 'id');
    // }

    public function scopeWithJob($query)
    {
        $query->join('employer_jobs as empjobs', function ($query) {
            $query->on('empjobs.id', '=', 'interview_schedule.employer_job_id');
            $query->whereNull('empjobs.deleted_at');
        });
        $query->activeCreatedBy('empjobs');
        return $query;
    }

    public function scopeWithJobSeeker($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'applied_jobs.user_id');
        })
        ->leftJoin('employer_jobs', function ($query) {
            $query->on('employer_jobs.id', '=', 'applied_jobs.employer_job_id');
            $query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        })
        ->leftJoin('job_seeker_detail', function ($query) {
            $query->on('job_seeker_detail.user_id', '=', 'users.id');
            $query->whereNull('job_seeker_detail.deleted_at')->where('job_seeker_detail.is_deleted', 0);
        });
    }
}
