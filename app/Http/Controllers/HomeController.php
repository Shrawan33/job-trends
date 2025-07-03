<?php

namespace App\Http\Controllers;

use App\Helpers\SeoHelper;
use App\Repositories\UserPackageRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserReviewRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $userPackageRepository;
    public $userRepository;
    public $userReviewRepository;

    public function __construct(UserPackageRepository $userPackageRepo, UserRepository $userRepo, UserReviewRepository $userReviewRepo)
    {
        $this->userPackageRepository = $userPackageRepo;
        $this->userRepository = $userRepo;
        $this->userReviewRepository = $userReviewRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured_jobseekers = $this->userRepository->getFeaturedUsers(3);
        $featured_employers = $this->userRepository->getFeaturedUsers(2);

        $reviewed_users = $this->userRepository->basicReviews();
        // dd($reviewed_users);
        //dd($feeds);
        $meta = SeoHelper::getMeta('home');
        return view('welcome')->with('locations', [])->with('states', [])->with('featured_jobseekers', $featured_jobseekers)->with('featured_employers', $featured_employers)->with('reviewed_users', $reviewed_users)->with('meta',$meta);
    }
}
