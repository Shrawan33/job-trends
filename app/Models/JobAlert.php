<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


/**
 * Class JobAlert
 * @package App\Models
 * @version February 9, 2021, 3:20 pm UTC
 *
 * @property integer $id
 * @property string $search_term
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class JobAlert extends Model
{
    use Notifiable;
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'job_alerts';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'id',
        'search_term',
        'location',
        'deleted_at',
        'created_by',
        'updated_by',
        'location_id',
        'state_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'search_term' => 'string',
        'location_id' => 'integer',
        'state_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'search_term' => 'required',
        'location_id' => 'required',
        'state_id' => 'required',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

}
