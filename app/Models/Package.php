<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Package
 * @package App\Models
 * @version March 31, 2021, 8:32 am UTC
 *
 * @property string $title
 * @property string $description
 * @property number $price
 * @property tinyInteger $duration
 * @property tinyInteger $grace_period
 * @property integer $profile_unlock_credits
 * @property integer $no_of_job_posts
 * @property integer $no_of_sms
 */
class Package extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'packages';

    public $json_fields = [
        'credits',
        'deduction'
    ];

    protected $appends = [
        'credits',
        'deduction'
    ];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'role_type',
        'package_type',
        'title',
        'description',
        'price',
        'duration',
        'grace_period',
        'credit_info',
        'is_default',
        'is_contact_sales',
        'is_best_selling',
        'is_deleted',
        'created_by',
        'updated_by',
        'package_category_id',
        'is_addon',
        'addon_list',
        'parent_package_id',
        'employer_package_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'price' => 'float',
        'is_default' => 'boolean',
        'is_contact_sales' => 'boolean',
        'is_best_selling' => 'boolean',
        'credit_info' => 'array',
        'package_category_id' => 'integer',
        'is_addon' => 'boolean',
        'addon_list' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'nullable',
        'price' => 'numeric|nullable',
        'duration' => 'numeric|nullable',
        'grace_period' => 'numeric|nullable',
        'profile' => 'required_with:profile_deduction|numeric|nullable',
        'profile_deduction' => 'required_with:profile|numeric|nullable',
        'job_posts' => 'required_with:job_posts_deduction|numeric|nullable',
        'job_posts_deduction' => 'required_with:job_posts|numeric|nullable',
        'sms' => 'required_with:sms_deduction|numeric|nullable',
        'sms_deduction' => 'required_with:sms|numeric|nullable'
    ];

    public function getCreditsAttribute()
    {
        return $this->credit_info['credits'] ?? null;
    }

    public function getDeductionAttribute()
    {
        return $this->credit_info['deduction'] ?? null;
    }



    /**
     * Get all of the comments for the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addOns(): HasMany
    {
        return $this->hasMany(Package::class, 'parent_package_id', 'id');
    }
}
