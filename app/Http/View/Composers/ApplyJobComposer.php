<?php

namespace App\Http\View\Composers;
use App\Helpers\FunctionHelper;
use App\Repositories\ApplyJobRepository;
use Illuminate\View\View;
use App\Models\ZoomMeeting;

class ApplyJobComposer

{
    private $applyJobRepository;
    private $repository;

    public function __construct(ApplyJobRepository $applyJobRepo)
    {
        $this->applyJobRepository = $applyJobRepo;

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
        $statusFilter = config('constants.candidate_status');

        // $zoommeeting = null;
        // if ($view->employer_job_id == 5 && $view->user_id == 6) {
        //     $zoommeeting = ZoomMeeting::where('jobseeker_id', $view->user_id)->where('employer_job_id', $view->employer_job_id)->first();
        //     dd($zoommeeting);
        // }
        // dd($zoommeeting);
        // if ($view->employer_job_id != null && $view->user_id != null) {
        //     $zoommeeting = ZoomMeeting::where('jobseeker_id', $view->user_id)->where('employer_job_id', $view->employer_job_id)->first();
        // }

        // return $view->with([
        //     'zoommeeting' => $zoommeeting
        // ]);
        return $view->with([
            'status' => $statuses,
            'statusFilter' => $statusFilter,
            'selectedStatusFilter' => request('candidate_status', ''),
        ]);
    }
}
