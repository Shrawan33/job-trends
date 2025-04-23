<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteJob extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'favorite_jobs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'employer_job_id',
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
        'employer_job_id' => 'integer',
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
        'employer_job_id' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function employerJob()
    {
        return $this->belongsTo(EmployerJob::class, 'employer_job_id', 'id');
    }

    public function scopeWithFavorite($query)
    {
        return $query->leftJoin('employer_jobs as empjobs', function ($query) {
            $query->on('empjobs.id', '=', 'favorite_jobs.employer_job_id');
            $query->whereNull('empjobs.deleted_at')->where('empjobs.is_deleted', 0);
        })
        ->leftJoin('categories as category', function ($query) {
            $query->on('category.id', '=', 'empjobs.category_id');
            $query->whereNull('category.deleted_at')->where('category.is_deleted', 0);
        });
    }
}
