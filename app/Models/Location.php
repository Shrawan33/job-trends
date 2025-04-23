<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Location
 * @package App\Models
 * @version January 22, 2021, 9:54 am UTC
 *
 * @property bigIncrements $id
 * @property string $name
 * @property unsignedBigInteger $created_by
 * @property unsignedBigInteger $updated_by
 * @property tinyInteger $is_deleted
 * @property string $deleted_at
 */
class Location extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'locations';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'title',
        'created_by',
        'updated_by',
        'is_deleted',
        'deleted_at',
        'state_id',
        'refrence_import_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'state_id' => 'integer',
        'refrence_import_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'state_id' => 'required'
    ];

    public static $messages = [
        'title.required' => 'Title Field is Required.',
        'state_id.required' => 'State Field is Required.',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function scopeWithState($query)
    {
        return $query->leftJoin('states', function ($query) {
            $query->on('states.id', '=', 'locations.state_id');
            $query->whereNull('states.deleted_at')->where('states.is_deleted', 0);
        });
    }
}
