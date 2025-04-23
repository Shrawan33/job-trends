<?php

namespace App\Models;

use App\Helpers\FunctionHelper;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserPackage
 * @package App\Models
 * @version April 5, 2021, 8:40 am UTC
 *
 * @property unsignedBigInteger $user_id
 * @property unsignedBigInteger $package_id
 * @property string $package_info
 * @property boolean $is_active
 * @property string $start_date
 * @property string $end_date
 */
class UserPackage extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'user_packages';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'package_id',
        'package_info',
        'utilization_info',
        'is_active',
        'start_date',
        'end_date',
        'grace_date',
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
        'package_info' => 'array',
        'utilization_info' => 'array',
        'is_active' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'grace_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'package_id' => 'required',
        'package_info' => 'required',
        'utilization_info' => 'required',
        'is_active' => 'nullable',
        'start_date' => 'nullable',
        'end_date' => 'nullable',
        'grace_date' => 'nullable'
    ];

    public function transactions()
    {
        return $this->hasMany(UserPackageTransaction::class, 'user_package_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function isEndDateExpired()
    {
        return $this->end_date > FunctionHelper::today(false, true) ?: false;
    }
}
