<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ShoppingCart
 * @package App\Models
 * @version September 1, 2023, 7:17 am UTC
 *
 */
class ShoppingCart extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'shopping_cart';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'cart_items',
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
        'user_id' => 'integer',
        'cart_items' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
