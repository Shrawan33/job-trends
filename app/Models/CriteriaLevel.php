<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CriteriaLevel
 * @package App\Models
 * @version May 27, 2021, 5:48 am UTC
 *
 * @property string $title
 * @property string $description
 * @property number $price
 * @property tinyInteger $duration
 * @property tinyInteger $grace_period
 * @property integer $profile_unlock_credits
 * @property integer $no_of_job_posts
 * @property integer $no_of_sms
 */
class CriteriaLevel extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'criteria_levels';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'criteria_id',
        'level',
        'score',
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
        'criteria_id' => 'integer',
        'level' => 'integer',
        'score' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'criteria_id' => 'required',
        'level' => 'required',
        'score' => 'required',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'id');
    }
}
