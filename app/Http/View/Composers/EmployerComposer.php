<?php
namespace App\Http\View\Composers;

use App\Models\User;
use App\Repositories\LocationRepository;
use App\Repositories\StateRepository;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class EmployerComposer
{
    private $stateRepository;
    private $userRepository;
    private $locationRepository;

    public function __construct(UserRepository $userRepo, LocationRepository $locationRepo, StateRepository $stateRepo)
    {

        $this->locationRepository = $locationRepo;
        $this->userRepository = $userRepo;
        $this->stateRepository = $stateRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    // public function compose(View $view)
    // {
    //     $locationFilter = ['' => ''] + $this->locationRepository->all()->pluck('title', 'id')->toArray();
    //     $stateFilter = ['' => ''] + $this->stateRepository->all()->pluck('title', 'id')->toArray();
    //     $companiesFilter = ['' => trans('label.company')] + User::orderBy('company_name','asc')->distinct('company_name')->pluck('company_name', 'company_name')->toArray();
    //     if ($view->entity['prefix'] == 'account') {
    //         $targetUrl = 'account-dashboard.index';
    //         $prefix = 'account.' ;
    //     } elseif ($view->entity['prefix'] == 'mentor') {
    //         $targetUrl = 'mentor_candidates.index';
    //         $prefix = 'mentor.';
    //     } else {
    //         $targetUrl = $view->entity['url'] . '.index' ;
    //         $prefix = '';
    //     }
    //     return $view->with([
    //         'locationFilter' => $locationFilter,
    //         'stateFilter' => $stateFilter,
    //         'companiesFilter' => $companiesFilter,
    //         'prefix' => $prefix
    //     ]);
    // }

    public function compose(View $view)
{
    $locationFilter = ['' => ''] + $this->locationRepository->all()->pluck('title', 'id')->toArray();
    $stateFilter = ['' => ''] + $this->stateRepository->all()->pluck('title', 'id')->toArray();

    $companiesFilter = ['' => trans('label.company')] +
        User::where(function ($query) {
            $query->whereNotNull('email_verified_at')
                ->orWhereNotNull('mobile_verified_at');
        })
        ->orderBy('company_name', 'asc')
        ->distinct('company_name')
        ->pluck('company_name', 'company_name')
        ->toArray();

    if ($view->entity['prefix'] == 'account') {
        $targetUrl = 'account-dashboard.index';
        $prefix = 'account.' ;
    } elseif ($view->entity['prefix'] == 'mentor') {
        $targetUrl = 'mentor_candidates.index';
        $prefix = 'mentor.';
    } else {
        $targetUrl = $view->entity['url'] . '.index';
        $prefix = '';
    }

    return $view->with([
        'locationFilter' => $locationFilter,
        'stateFilter' => $stateFilter,
        'companiesFilter' => $companiesFilter,
        'prefix' => $prefix
    ]);
}

}
