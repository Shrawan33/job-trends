<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Testimonial
 * @package App\Models
 * @version March 15, 2021, 5:58 pm UTC
 *
 * @property string $client
 * @property string $location
 * @property string $description
 */
class Testimonial extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;
    use DocumentRelationship;

    public $table = 'testimonials';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'client',
        'location',
        'description',
        'created_by',
        'updated_by',
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client' => 'string',
        'location' => 'string',
        'description' => 'string',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client' => 'required',
        'location' => 'required',
        'description' => 'required',
        'title' => 'required'
    ];


}
