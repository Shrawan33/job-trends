<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AppliedJobQuestionnaire
 * @package App\Models
 * @version March 22, 2021, 9:40 am UTC
 *
 * @property unsignedInteger $applied_job_id
 * @property unsignedInteger $questionnaire_id
 * @property string $answer
 * @property unsignedInteger $option_id
 * @property boolean $is_correct
 */
class AppliedJobQuestionnaire extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'applied_job_questionnaires';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'applied_job_id',
        'questionnaire_id',
        'answer',
        'option_id',
        'is_correct',
        'created_by',
        'updated_by',
        'is_deleted'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'answer' => 'string',
        'is_correct' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'applied_job_id' => 'required',
        'questionnaire_id' => 'required'
    ];

    public function question()
    {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id', 'id');
    }
}
