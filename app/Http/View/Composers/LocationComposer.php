<?php

namespace App\Http\View\Composers;

use App\Repositories\CountryRepository;
use App\Repositories\StateRepository;
use Illuminate\View\View;

class LocationComposer
{
    public $stateRepository;
    public $countryRepository;

    public function __construct(StateRepository $stateRepo, CountryRepository $countryRepo)
    {
        $this->stateRepository = $stateRepo;
        $this->countryRepository = $countryRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $states = $this->stateRepository->all([], null, null, [], [], ['title' => 'ASC'])->pluck('title', 'id')->toArray();
        $countries = $this->countryRepository->all([], null, null, [], [], ['name' => 'ASC'])->pluck('name', 'id')->toArray();
        switch ($view->getName()) {
            case 'categories.create':

                break;
        }

        $view->with([
            'states' => $states,
            'countries' => $countries
        ]);
    }
}
