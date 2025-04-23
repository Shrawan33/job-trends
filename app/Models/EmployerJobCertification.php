<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployerJobCertification extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'employer_job_certifications';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'employer_job_id',
        'certification_id',
        'updated_by',
        'created_by',
        'is_deleted',
        'deleted_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'employer_job_id' => 'integer',
        'certification_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function certification()
    {
        return $this->belongsTo(Certification::class, 'certification_id', 'id');
    }

    public function employerJob()
    {
        return $this->belongsTo(EmployerJob::class, 'employer_job_id', 'id');
    }
}
