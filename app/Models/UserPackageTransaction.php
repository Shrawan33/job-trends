<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserPackageTransaction
 * @package App\Models
 * @version April 5, 2021, 3:23 pm UTC
 *
 * @property unsignedBigInteger $user_id
 * @property unsignedBigInteger $user_package_id
 * @property string $credit_type
 * @property unsignedBigInteger $transactable_id
 * @property string $transactable_type
 * @property unsignedInteger $deducted_credit
 * @property unsignedInteger $remaining_credit
 */
class UserPackageTransaction extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'user_package_transactions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'user_package_id',
        'credit_type',
        'transactable_id',
        'transactable_type',
        'deducted_credit',
        'remaining_credit',
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
        'credit_type' => 'string',
        'transactable_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'user_package_id' => 'required',
        'credit_type' => 'required',
        'transactable_id' => 'required',
        'transactable_type' => 'required',
        'deducted_credit' => 'required',
        'remaining_credit' => 'required'
    ];

    public function transactable()
    {
        return $this->morphTo();
    }

    public function userPackage()
    {
        return $this->hasOne(UserPackage::class, 'id', 'user_package_id')->where('is_active', 1)->where('package_info->is_default', 0);
    }
}
