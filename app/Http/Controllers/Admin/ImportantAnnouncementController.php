<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Notifications\SendImportantAnnouncementNotification;
use App\Repositories\ApplyJobRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ImportantAnnouncementController extends AppBaseController
{

    public $applyJobRepository;

    public function __construct(ApplyJobRepository $applyJobRepository)
    {
        $this->applyJobRepository = $applyJobRepository;
        $this->getEntity('important-announcements');
    }

    public function create(Request $request)
    {
        try {

            return view($this->entity['view'] . '.create', ['entity' => $this->entity]);

        } catch (\Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'selected_audience' => 'required',
                'subject' => 'required',
                'message' => 'required'
            ]);

            $country = $request->country_id;
            $state = $request->state_id;

            $audience = $request->selected_audience;
            $message = $request->message??'';
            $subject = $request->subject??'';

            if (in_array(0, $audience)) {
                // send to jobseeker only
                $jobseekers = User::members(['jobseeker']);

                if ($country) {
                    $jobseekers->whereHas('seekerDetail', function ($query) use($country){
                        $query->where('country_id', $country);
                    });
                }

                if ($country && $state) {
                    $jobseekers->whereHas('seekerDetail', function ($query) use($country, $state){
                        $query->where('country_id', $country);
                        $query->where('state_id', $state);
                    });
                }
                
                foreach ($jobseekers->get() as $jobseeker) {
                    $jobseeker->notify(new SendImportantAnnouncementNotification($jobseeker, $subject, $message));
                }
            }

            if (in_array(1, $audience)){
                // send to employer
                $employers = User::members(['employer']);

                if ($country) {
                    $employers->whereHas('usersProfile', function ($query) use($country){
                        $query->where('country_id', $country);
                    });
                }

                if ($country && $state) {
                    $employers->whereHas('usersProfile', function ($query) use($country, $state){
                        $query->where('country_id', $country);
                        $query->where('state_id', $state);
                    });
                }

                foreach ($employers->get() as $employer) {
                    $employer->notify(new SendImportantAnnouncementNotification($employer,  $subject, $message));
                }
            }

            Flash::success('Message send successfully');
            return redirect()->route("important-announcements.create");

        } catch (\Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

    }

}
