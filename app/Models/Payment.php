<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 * @version April 29, 2021, 12:23 pm UTC
 *
 * @property unsignedBigInteger $user_id
 * @property tinyInteger $entity_type
 * @property unsignedBigInteger $package_id
 * @property string $session_id
 * @property unsignedBigInteger $buy_order
 * @property number $amount
 * @property string $token
 * @property tinyInteger $transaction_status
 * @property json $transaction_response
 */
class Payment extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'payments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'entity_type',
        'package_id',
        'session_id',
        'buy_order',
        'amount',
        'token',
        'transaction_status',
        'transaction_response',
        'renew_package',
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
        'session_id' => 'string',
        'amount' => 'float',
        'token' => 'string',
        'transaction_response' => 'array',
        'renew_package' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required|numeric'
    ];

    /**
     * Get the user that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
