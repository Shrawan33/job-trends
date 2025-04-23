<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Questionnaire
 * @package App\Models
 * @version March 19, 2021, 12:33 pm UTC
 *
 * @property EmployerJob $employerJob
 * @property User $updatedBy
 * @property \Illuminate\Database\Eloquent\Collection $questionnaireOptions
 * @property integer $employer_job_id
 * @property string $title
 * @property boolean $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 */
class Questionnaire extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'questionnaire';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'employer_job_id',
        'title',
        'is_deleted',
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
        'employer_job_id' => 'integer',
        'title' => 'string',
        'is_deleted' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'employer_job_id' => 'required|integer',
        'title' => 'nullable|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function employerJob()
    {
        return $this->belongsTo(EmployerJob::class, 'employer_job_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function questionnaireOptions()
    {
        return $this->hasMany(QuestionnaireOption::class, 'questionnaire_id');
    }
}
