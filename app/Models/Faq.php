<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Faq
 * @package App\Models
 * @version March 3, 2021, 9:48 am UTC
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Faq extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'faqs';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'question',
        'answer',
        'created_at',
        'updated_at',
        'deleted_at',
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
        'question' => 'string',
        'answer' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question' => 'required',
        'answer' => 'required'
    ];
}
