<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class State
 * @package App\Models
 * @version March 11, 2021, 6:02 am UTC
 *
 * @property string $title
 */
class State extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'states';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'created_by',
        'updated_by',
        'refrence_import_id',
        'country_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'refrence_import_id' =>'id'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    public function scopeWithCountry($query)
    {
        return $query->leftJoin('countries', function ($query) {
            $query->on('countries.id', '=', 'states.country_id');
            $query->whereNull('countries.deleted_at');
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

}
