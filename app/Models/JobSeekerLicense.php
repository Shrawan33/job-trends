<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeekerLicense extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'job_seeker_license';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'certificate_name',
        'certifying_authority',
        'from_month',
        'from_year',
        'seeker_detail_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'certificate_name' => 'string',
        'certifying_authority' => 'string',
        'from_month' => 'integer',
        'from_year' => 'integer',

        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'certificate_name' => 'required',
        'certifying_authority' => 'required',
    ];
    public function messages()
    {
        $messages = [
            'certificate_name.required' => 'Certificate Name field is required.',
            'certifying_authority.required' => 'Certifying Authority field is required.',
            'password.confirmed' => 'New password & Re-entered password does not match.'
        ];

        return $messages;
    }
    public function license()
    {
        return $this->belongsTo(Certification::class, 'certificate_id', 'id');
    }
}
