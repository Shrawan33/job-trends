<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionnaireOption
 * @package App\Models
 * @version March 19, 2021, 12:35 pm UTC
 *
 * @property Questionnaire $questionnaire
 * @property integer $questionnaire_id
 * @property string $title
 * @property boolean $is_correct
 * @property boolean $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 */
class QuestionnaireOption extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'questionnaire_options';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'questionnaire_id',
        'title',
        'is_correct',
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
        'questionnaire_id' => 'integer',
        'title' => 'string',
        'is_correct' => 'boolean',
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
        'questionnaire_id' => 'nullable|integer',
        'title' => 'nullable|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
    }
}
