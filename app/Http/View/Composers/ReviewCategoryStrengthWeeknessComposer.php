<?php

namespace App\Http\View\Composers;

use App\Models\User;
use App\Repositories\BadgeRepository;
use App\Repositories\ReviewCategoryRepository;
use Illuminate\View\View;

class ReviewCategoryStrengthWeeknessComposer
{
    public $reviewCategoryRepository;
    public $badgeRepository;

    public function __construct(ReviewCategoryRepository $reviewCategoryRepo, BadgeRepository $badgeRepo)
    {
        $this->reviewCategoryRepository = $reviewCategoryRepo;
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
        $review_categories = $this->reviewCategoryRepository->all([], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->toArray();
        $badges = $this->badgeRepository->all([], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->toArray();
        $review_category_types = config('constants.review_category_type');
        //dd($review_categories);
        $view->with([
            'review_categories' => $review_categories,
            'review_category_types' => $review_category_types,
            'badges' => $badges
        ]);
    }
}
