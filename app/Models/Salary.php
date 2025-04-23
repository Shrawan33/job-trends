<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Salary
 * @package App\Models
 * @version January 18, 2021, 3:09 pm UTC
 *
 * @property string $title
 */
class Salary extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'salaries';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'start',
        'end',
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
        'id' => 'integer',
        'title' => 'string',
        'start' => 'integer',
        'end' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'start' => 'required',
        'end' => 'required'
    ];
}
