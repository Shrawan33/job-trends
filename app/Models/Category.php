<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DocumentRelationship;

/**
 * Class Category
 * @package App\Models
 * @version January 12, 2021, 7:09 am UTC
 *
 * @property string $title
 */
class Category extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ToSqlDate;
    use ModelState;
    use DocumentRelationship;

    public $table = 'categories';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'parent_id',
        'title',
        'created_by',
        'updated_by',
        'is_deleted',
        'slug',
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
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'reference_import_id' => 'id'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => ['required', 'unique:categories,title,NULL,id,deleted_at,NULL']
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'id', 'parent_id');
    }

    public function totalJobs()
    {
        return $this->hasMany(EmployerJob::class, 'category_id', 'id');

        // return $this->hasMany(EmployerJob::class, 'category_id', 'id')->whereHas('createdByUserWithActivePackage');
    }

    public function jobs()
    {
        return $this->hasMany(EmployerJob::class)->where('approval_status', 1);
    }


    public function scopeWithParent($query)
    {
        return $query->leftJoin('categories as parent', function ($query) {
            $query->on('parent.id', '=', 'categories.parent_id');
            $query->whereNull('parent.deleted_at')->where('parent.is_deleted', 0);
        });
    }
}
