<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JobType
 * @package App\Models
 * @version March 10, 2023, 9:45 am UTC
 *
 * @property string $title
 * @property boolean $is_approval_needed
 * @property integer $user_id
 */
class JobType extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'job_types';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'is_approval_needed',
        'user_id',
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
        'is_approval_needed' => 'boolean',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
