<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cms
 * @package App\Models
 * @version January 22, 2021, 9:54 am UTC
 *
 * @property bigIncrements $id
 * @property string $name
 * @property unsignedBigInteger $created_by
 * @property unsignedBigInteger $updated_by
 * @property tinyInteger $is_deleted
 * @property string $deleted_at
 */
class Cms extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'cms';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'page_name',
        'title',
        'description',
        'created_by',
        'updated_by',
        'is_deleted',
        'deleted_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'page_name' => 'string',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'page_name' => 'required',
        'title' => 'required'
    ];
}
