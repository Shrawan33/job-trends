<?php

namespace App\Models;

use App\Traits\ApprovalStatus;
use App\Traits\DocumentRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\JobSeekerDetail;

use Illuminate\Notifications\Notifiable;
class UserReview extends Model
{
    use SoftDeletes;
    use DocumentRelationship;
    use ApprovalStatus;
    use Notifiable;

    public $table = 'user_reviews';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];
    //protected $appends = ['user_address'];

    public $fillable = [
        'review_from_id',
        'review_to_id',
        'review_type',
        'review',
        'badge_id',
        'badge_strength',
        'badge_weekness',
        'is_anonymous',
        'approval_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'review_from_id' => 'integer',
        'review_to_id' => 'integer',
        'review_type' => 'integer',
        'review' => 'string',
        'badge_id' => 'integer',
        'badge_strength' => 'array',
        'badge_weekness' => 'array',
        'is_anonymous' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'review' => 'required',
        'badge_strength' => 'required',
        'badge_weekness' => 'required'
    ];

    public function scopeWithReviewer($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'user_reviews.review_from_id');
            //$query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        });
    }

    public function scopeWithReviewed($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'user_reviews.review_to_id');
            //$query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        });
    }

    public function scopeWithBadge($query)
    {
        return $query->leftJoin('badges', function ($query) {
            $query->on('badges.id', '=', 'user_reviews.badge_id');
            //$query->whereNull('employer_jobs.deleted_at')->where('employer_jobs.is_deleted', 0);
        });
    }
    // public function setBadgeStrengthAttribute($value)
    // {
    //     dd($value);
    //     $this->attributes['badge_strength'] = json_encode($value);
    // }
    public function usersProfile()
    {
        return $this->belongsTo(UserProfile::class, 'id', 'user_id');
    }
    // public function reviewFromUser()
    // {
    //     return $this->belongsTo(User::class, 'review_from_id','id');
    // }

    // public function reviewToUser()
    // {
    //     return $this->belongsTo(User::class, 'review_to_id', 'id');
    // }
    public function reviewFromUser()
    {
        return $this->belongsTo(User::class, 'review_from_id', 'id')->withTrashed();
    }

    public function reviewToUser()
    {
        return $this->belongsTo(User::class, 'review_to_id', 'id')->withTrashed();
    }

    public function scopeWithEmployer($query)
    {
        return $query->leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'user_reviews.created_by');
            $query->whereNull('user_reviews.deleted_at')->where('user_reviews.is_deleted', 0);
        });
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }

    public function approveReview()
    {
        $this->approval_status = 1; // 1 for approved
        $this->save();
    }

    public function scopeWithRole($query)
    {
        return $query->leftJoin('model_has_roles', function ($query) {
            $query->on('users.id', '=', 'model_has_roles.model_id');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'review_from_id'); // Assuming the foreign key is 'user_id' in the user_reviews table
    }
    public function scopeOfEmployeeName($query)
    {
        return $query->join('users', function ($query) {
            $query->on('users.id', '=', 'review_from_id');
        });
    }
}
