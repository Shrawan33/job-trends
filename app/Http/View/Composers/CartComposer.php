<?php

namespace App\Http\View\Composers;

use App\Models\User;
use App\Repositories\CartRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\LocationRepository;
use App\Repositories\StateRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartComposer
{
    public $cartRepository;
    private $locationRepository;
    private $stateRepository;
    private $seekerDetailRepository;

    public function __construct(CartRepository $cartRepo, LocationRepository $locationRepo, JobSeekerDetailRepository $jobSeekerDetailRepo, StateRepository $stateRepo)
    {
        $this->cartRepository = $cartRepo;
        $this->locationRepository = $locationRepo;
        $this->stateRepository = $stateRepo;
        $this->seekerDetailRepository = $jobSeekerDetailRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $states = [];
        $locations = [];
        $selectedState = [];
        $selectedLocation = [];

        $seekerDetail = !empty($view->user->seekerDetail) ? $view->user->seekerDetail : $this->seekerDetailRepository->makeModel();

        $cartCount = 0;
        if (Auth::check()) {

            $cart = $this->cartRepository->getCartCount(Auth::id());
            if ($cart) {
                $cartCount = count($cart['cart_items']);
            }
        }
        if (!empty(old())) {
            if (!empty(old('location_id'))) {
                $locations = $this->locationRepository->all(['id' => old('location_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
            }
            if (!empty(old('state_id'))) {
                $states = $this->stateRepository->all(['id' => old('state_id')], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->all();
            }

        } else {
            if (!empty($seekerDetail->location)) {
                $locations = $seekerDetail->location->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
            }
            if (!empty($seekerDetail->state)) {
                $states = $seekerDetail->state->pluck('title', 'id')->all([], null, null, [], [], ['title' => 'ASC']);
            }


        }
        $view->with([
            'cartCount' => $cartCount,
            'selectedLocation' => $selectedLocation,
            'selectedState' => $selectedState,
            'seekerDetail' => $seekerDetail,
            'states' => $states,
            'locations' => $locations
        ]);
    }
}
