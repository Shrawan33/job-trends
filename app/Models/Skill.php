<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Skill
 * @package App\Models
 * @version January 18, 2021, 5:19 am UTC
 *
 * @property string $title
 */
class Skill extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'skills';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'created_by',
        'updated_by',
        'is_deleted',
        'reference_import_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'reference_import_id' => 'id'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];
}
