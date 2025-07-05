<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Blog
 * @package App\Models
 * @version March 15, 2021, 7:37 am UTC
 *
 * @property string $title
 * @property string $description
 */
class Blog extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use DocumentRelationship;

    public $table = 'blogs';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'description',
        'created_by',
        'createdBy',
        'createdDate',
        'updated_by',
        'small_description',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'createdBy' => 'string',
        'createdDate' => 'date',
        'createdBy' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'createdBy' => 'required',
        'createdDate' => 'required',
    ];

    protected static function booted()
    {
        static::created(function () {
            \App\Http\Controllers\SitemapController::generateSitemapStatic();
        });

        static::deleted(function () {
            \App\Http\Controllers\SitemapController::generateSitemapStatic();
        });
    }

}
