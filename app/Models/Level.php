<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Level
 * @package App\Models
 * @version January 20, 2023, 6:48 am UTC
 *
 * @property string $title
 */
class Level extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'levels';


    protected $dates = ['deleted_at'];

    public $fillable = [
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
        'title' => 'string',
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
