<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderHeader
 * @package App\Models
 * @version September 7, 2023, 9:18 am UTC
 *
 */
class OrderHeader extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use DocumentRelationship;

    public $table = 'order_headers';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'item_info',
        'user_info',
        'payment_status',
        'payment_info',
        'order_process_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'order_number' => 'string',
        'total_amount' => 'float',
        'item_info' => 'array',
        'user_info' => 'array',
        'payment_status' => 'boolean',
        'payment_info' => 'array',
        'order_process_status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getStateIdAttribute()
    {
        $userInfo = json_decode($this->attributes['user_info'], true);
        return $userInfo['state_id'] ?? null;
    }

    public function getLocationIdAttribute()
    {
        $userInfo = json_decode($this->attributes['user_info'], true);
        return $userInfo['location_id'] ?? null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function getShortAddressAttribute()
    {
        $userInfo = json_decode($this->attributes['user_info'], true);

        $address = [
            'district' => $this->location->title ?? null,
            'state' => $this->state->title ?? null,
            'pincode' => $userInfo['postal_code'] ?? null
        ];
        return implode(', ', array_filter($address));
    }

    public function scopeWithUser($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'order_headers.user_id');
            $query->whereNull('order_headers.deleted_at');
        });
    }

    public function prepareInput($item)
    {
        // dd($item->user_info['first_name']);
        $item->order_number = !empty($item->order_number) ? $item->order_number : '';
        // dd($item);

        return $item;
    }


}
