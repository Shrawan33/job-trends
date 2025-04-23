<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Models
 * @version November 30, 2023, 9:08 am UTC
 *
 * @property string $event_title
 * @property string $event_description
 */
class Event extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use DocumentRelationship;


    public $table = 'events';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'event_title',
        'event_description',
        'event_date',
        'small_description',
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
        'event_title' => 'string',
        'event_description' => 'string',
        // 'event_date' => 'datetime'
        'event_date' => 'datetime:Y-m-d',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'event_title' => 'required'
    ];


}
