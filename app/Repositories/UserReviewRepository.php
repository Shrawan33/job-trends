<?php

namespace App\Repositories;

use App\Models\UserReview;
use App\Repositories\BaseRepository;

/**
 * Class UserReviewRepository
 * @package App\Repositories
 * @version July 3, 2023, 11:48 am UTC
*/

class UserReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'review_from_id',
        'review_to_id',
        'approval_status',
        'is_anonymous',
        'badge_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserReview::class;
    }

    public function reviews($candidate_id, $badge_id = false) {
        $query = $this->allQuery();
        $query->WithReviewer();
        $query->WithBadge();
        $query->selectRaw('user_reviews.*, badges.id as badge_id, badges.title as badge_title, users.first_name, users.last_name');
        $query->where('user_reviews.approval_status', 1);
        $query->where('user_reviews.review_type', 2);
        $query->where('review_to_id', $candidate_id);
        if ($badge_id) {
            $query->where('badge_id', $badge_id);
        }
        $query->whereNull('user_reviews.deleted_at');
        $query->orderBy('user_reviews.created_at', 'DESC');
        return $query->get();
    }

    public function basicReviews() {
        $query = $this->allQuery();
        $query->with('reviewToUser');
        $query->WithReviewed();
        $query->WithRole();

        $query->selectRaw('user_reviews.*, users.id, users.first_name, users.last_name, users.company_name, model_has_roles.*');
        $query->where('user_reviews.review_type', 1);

        $query->groupBy('users.id');
        $query->orderBy('user_reviews.created_at', 'DESC');
        $query->limit('10');
        return $query->get();
    }

}
