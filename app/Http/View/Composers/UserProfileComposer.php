<?php

namespace App\Http\View\Composers;

use App\Repositories\CountryRepository;
use App\Repositories\LocationRepository;
use App\Repositories\StateRepository;
use App\Repositories\UserProfileRepository;
use Illuminate\View\View;

class UserProfileComposer
{
    private $userProfileRepository;
    private $locationRepository;
    private $stateRepository;


    public function __construct(UserProfileRepository $userProfileRepo, LocationRepository $locationRepo, StateRepository $stateRepo)
    {
        $this->userProfileRepository = $userProfileRepo;
        $this->locationRepository = $locationRepo;
        $this->stateRepository = $stateRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $usersProfile = [];
        $locations = [];
        $states = [];
        switch ($view->getName()) {
            case 'auth.employer.profile.edit':
                if (!empty($view->user->usersProfile->district)) {
                    $locations = $view->user->usersProfile->district->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                }
                if (!empty($view->user->usersProfile->state)) {
                    $states = $view->user->usersProfile->state->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
                }
                break;
            case 'auth.employer.profile.show':
                $usersProfile = $view->user->usersProfile ?? [];
                break;
        }
        if (empty($usersProfile)) {
            $usersProfile = $this->userProfileRepository->makeModel();
        }
        if (!empty(old())) {
            if (!empty(old('location_id'))) {
                $locations = $this->locationRepository->all(['id' => old('location_id')])->pluck('title', 'id')->all();
            }
            if (!empty(old('state_id'))) {
                $states = $this->stateRepository->all(['id' => old('state_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
            }

        }

        $view->with([
            'usersProfile' => $usersProfile,
            'states' => $states,
            'locations' => $locations
        ]);
    }
}
