<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteCandidate extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'favourite_candidates';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'created_by',
        'updated_by',
        'status',
        'suggested_title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'status' => 'string',
        'suggested_title' => 'string'
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

    public function remarks()
    {
        return $this->hasMany(Remark::class, 'shortlisted_id', 'id');
    }

    public function scopeWithFavorite($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'favourite_candidates.user_id');
            $query->where('users.deleted_at', null);
            $query->where('users.is_deleted', 0);
        })->leftJoin('job_seeker_detail', function ($query) {
            $query->on('job_seeker_detail.user_id', '=', 'users.id');
        });
    }

    public function appliedJobs()
    {
        return $this->hasManyThrough(EmployerJob::class, ApplyJob::class, 'user_id', 'id', 'user_id', 'employer_job_id')->where('employer_jobs.created_by', '=', auth()->user()->id)->where('applied_jobs.user_id', '!=', null);
    }
}
