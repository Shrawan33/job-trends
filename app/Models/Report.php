<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'report_abuses';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'reporter_id',
        'reported_type',
        'reported_id',
        'content',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'reporter_id' => 'integer',
        'reported_type' => 'string',
        'reported_id' => 'integer',
        'content' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id', 'id');
    }

    public function reportedJob()
    {
        return $this->belongsTo(EmployerJob::class, 'reported_id', 'id');
    }

    public function reportedCandidate()
    {
        return $this->belongsTo(User::class, 'reported_id', 'id');
    }

    public function reported()
    {
        return $this->morphTo()->withTrashed();
    }

    public function scopeWithMorph($query)
    {
        return $query->leftJoin('employer_jobs', function ($query) {
            $query->on('employer_jobs.id', '=', 'report_abuses.reported_id');
            $query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        })
        ->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'report_abuses.reporter_id');
        });
    }

    public function scopeWithRole($query)
    {
        return $query->leftJoin('model_has_roles', function ($query) {
            $query->on('users.id', '=', 'model_has_roles.model_id');
        });
    }
}
