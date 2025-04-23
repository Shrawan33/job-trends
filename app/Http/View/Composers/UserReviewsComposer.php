<?php

namespace App\Http\View\Composers;

use App\Models\User;
use App\Repositories\BadgeRepository;
use App\Repositories\ReviewCategoryRepository;
use Illuminate\View\View;

class UserReviewsComposer
{
    public $reviewCategoryRepository;
    public $badgeRepository;

    public function __construct(BadgeRepository $badgeRepo)
    {
        $this->badgeRepository = $badgeRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $badges = $this->badgeRepository->all([], null, null, [], ['weeknesses', 'responsibilities'], ['title' => 'ASC']);

        $review_category_types = config('constants.review_category_type');
        //dd($review_categories);
        $view->with([
            'badges' => $badges,
            'review_category_types' => $review_category_types
        ]);
    }
}
