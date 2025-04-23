<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ReviewCategoryStrengthWeekness
 * @package App\Models
 * @version June 23, 2023, 5:45 am UTC
 *
 * @property unsignedInteger $review_category_id
 * @property integer $review_category_type
 * @property string $title
 */
class ReviewCategoryStrengthWeekness extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'review_category_strength_weeknesses';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'badge_id',
        'review_category_type',
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
        'id' => 'integer',
        'review_category_type' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'badge_id' => 'required',
        'title' => 'required'
    ];



    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id', 'id');
    }

}
