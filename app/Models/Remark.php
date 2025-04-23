<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remark extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'remarks';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'shortlisted_id',
        'content',
        'created_by',
        'updated_by',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'shortlisted_id' => 'integer',
        'content' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'content' => 'required'
    ];

    public function shortlist()
    {
        return $this->belongsTo(FavoriteCandidate::class, 'shortlisted_id', 'id');
    }
}
