<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Badge
 * @package App\Models
 * @version June 26, 2023, 12:39 pm UTC
 *
 * @property string $title
 */
class Badge extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use DocumentRelationship;

    public $table = 'badges';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'min_review_count',
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
        'title' => 'string',
        'min_review_count' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'min_review_count' => 'required'
    ];

    public function weeknesses()
    {
        return $this->hasMany(ReviewCategoryStrengthWeekness::class, 'badge_id', 'id')->where('review_category_type', 2);
    }

    public function responsibilities()
    {
        return $this->hasMany(ReviewCategoryStrengthWeekness::class, 'badge_id', 'id')->where('review_category_type', 1);
    }

    public function totalReviews()
    {
        return $this->hasMany(UserReview::class, 'badge_id', 'id');

        // return $this->hasMany(EmployerJob::class, 'category_id', 'id')->whereHas('createdByUserWithActivePackage');
    }
}
