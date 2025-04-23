<?php

namespace App\Http\View\Composers;

use App\Repositories\BannerManagementRepository;
use App\Repositories\BlogRepository;
use Illuminate\View\View;
use App\Repositories\CategoryRepository;
use App\Repositories\EventRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\PackageRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\WorkTypeRepository;


class FrontHomeComposer
{
    private $categoryRepository;
    private $eventRepository;
    private $employerJobRepository;
    private $testimonialRepository;
    private $blogRepository;
    private $bannerManagementRepository;
    private $packageRepository;
    private $workTypeRepository;

    public function __construct(EventRepository $eventRepository, CategoryRepository $categoryRepository, EmployerJobRepository $employerJobRepo, TestimonialRepository $testimonialRepo, BlogRepository $blogRepo, BannerManagementRepository $bannerManagementRepo, PackageRepository $packageRepo, WorkTypeRepository $worktypeRepo)
    {
        $this->categoryRepository = $categoryRepository;
        $this->employerJobRepository = $employerJobRepo;
        $this->testimonialRepository = $testimonialRepo;
        $this->blogRepository = $blogRepo;
        $this->bannerManagementRepository = $bannerManagementRepo;
        $this->packageRepository = $packageRepo;
        $this->workTypeRepository = $worktypeRepo;
        $this->eventRepository = $eventRepository;

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = $this->categoryRepository->all([], null, config('constants.home_categories_count', 4), [], ['totalJobs'], ['total_jobs_count' => 'desc', 'title' => 'asc'], [], null, ['totalJobs']);
        $events = $this->eventRepository->all();
        $jobs = $this->employerJobRepository->all(['is_featured' => 0], null, config('constants.home_jobs_count', 6), ['*'], [], ['created_at' => 'desc'], [], null, [], []);
        $featured = $this->employerJobRepository->all(['is_featured' => 1], null, config('constants.home_featured_count', 6), ['*'], [], ['created_at' => 'desc'], [], null, [], []);
        $urgent = $this->employerJobRepository->all(['is_urgent' => 1, 'approval_status' => 1], null, config('constants.home_featured_count', 6), ['*'], [], ['expiration_date' => 'desc'], [], null, [], []);
        $testimonials = $this->testimonialRepository->all();
        $blogs = $this->blogRepository->all([], null, 3);
        $banners = $this->bannerManagementRepository->all();
        $packages = [];
        $workTypes = $this->workTypeRepository->all();

        //company list
        $query = $this->employerJobRepository->allQuery();
        $query->selectRaw('company_name, COUNT(company_name) as cnt_job');
        $query->groupBy('company_name');
        $companies = $query->get();

        if (!auth()->guest() && auth()->user()->hasRole('employer')) {
           $packages = $this->packageRepository->all(['is_default' => 0]);
        }

        return $view->with([
            'events' => $events,
            'categories' => $categories,
            'jobs' => $jobs,
            'featured' => $featured,
            'companies' => $companies,
            'testimonials' => $testimonials,
            'blogs' => $blogs,
            'banners' => $banners,
            'packages' => $packages,
            'urgent' => $urgent,
            'workType' => $workTypes
        ]);
    }
}
