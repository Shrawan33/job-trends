<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployerJobQualification extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'employer_job_qualifications';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'employer_job_id',
        'qualification_id',
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
        'qualification_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'id');
    }

    public function employerJob()
    {
        return $this->belongsTo(EmployerJob::class, 'employer_job_id', 'id');
    }
}
