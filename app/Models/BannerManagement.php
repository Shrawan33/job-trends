<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BannerManagement
 * @package App\Models
 * @version March 1, 2021, 1:21 pm UTC
 *
 * @property integer $id
 * @property string $title
 * @property string $tag_line
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class BannerManagement extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use DocumentRelationship;

    public $table = 'banner_managements';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'title',
        'tag_line',
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
        'title' => 'string',
        'tag_line' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'created_at' => 'required',
        'updated_at' => 'required',
        'deleted_at' => 'required'
    ];
}
