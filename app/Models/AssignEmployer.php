<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignEmployer extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'assign_employer';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'employer_id',
        'account_manager_id',
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
        'employer_id' => 'integer',
        'account_manager_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'employer_id' => 'required',
        'account_manager_id' => 'required',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }

    public function accountManager()
    {
        return $this->belongsTo(User::class, 'account_manager_id', 'id');
    }

    public function scopeWithEmployer($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('assign_employer.employer_id', '=', 'users.id');
        });
    }
}
