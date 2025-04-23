<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\ApplicationTrackingRepository;

class ApplicationComposer
{
    private $repository;

    public function __construct(ApplicationTrackingRepository $ApplicationTrackingRepos)
    {
        $this->repository = $ApplicationTrackingRepos;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $statuses = config('constants.application_tracking_status');
        $application = $this->repository->all(['user_id' => $view->candidate->id])->first();
        if (!empty($application)) {
            $application = $application;
        }

        // $application = $this->repository->all(['user_id'=>$view->candidate->id])->pluck('status')->toArray();

        return $view->with([
            'statuses' => $statuses,
            'application' => $application
        ]);
    }
}
