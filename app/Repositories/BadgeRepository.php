<?php

namespace App\Repositories;

use App\Models\Badge;
use App\Repositories\BaseRepository;

/**
 * Class BadgeRepository
 * @package App\Repositories
 * @version June 26, 2023, 12:39 pm UTC
*/

class BadgeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
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
        return Badge::class;
    }

    // public function getBadges($candidate_id) {
    //     $query = $this->allQuery();
    //     $query->withCount(['totalReviews' => function($query) use ($candidate_id) {
    //         $query->where('review_type', 2)->where('review_to_id', $candidate_id)->where('approval_status', 1);
    //     }]);
    //     $query->with('totalReviews');
    //     $query->selectRaw('badges.id, badges.title as title');
    //     $query->orderBy('total_reviews_count', 'DESC');
    //     $query->orderBy('title', 'ASC');
    //     return $query->get();
    // }
    public function getBadges($candidate_id)
    {
        $query = $this->allQuery();
        $query->withCount(['totalReviews' => function ($query) use ($candidate_id) {
            $query->where('review_type', 2)
                  ->where('approval_status', 1)
                  ->whereHas('reviewFromUser', function ($query) {
                      $query->where('is_deleted', 0);
                  })
                  ->whereHas('reviewToUser', function ($query) use ($candidate_id) {
                      $query->where('id', $candidate_id)->where('is_deleted', 0);
                });
        }]);
        $query->with('totalReviews');
        $query->selectRaw('badges.id, badges.title as title');
        $query->orderBy('total_reviews_count', 'DESC');
        $query->orderBy('title', 'ASC');
        return $query->get();
    }

}
