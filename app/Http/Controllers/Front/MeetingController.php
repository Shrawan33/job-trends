<?php

namespace App\Http\Controllers\Front;

use App\Models\ZoomMeeting;
use App\Traits\ZoomMeetingTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Laracasts\Flash\Flash;
use Throwable;

class MeetingController extends AppBaseController
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    public $userrepository;

    // public function __construct(UserRepository $userRepo)
    // {
    //     $this->userrepository = $userRepo;
    //     $this->getEntity('meetings');
    // }

    public function index($id)
    {
        $meeting = $this->get($id);
        return view('meetings.index', compact('meeting'));
    }

    public function show($id)
    {
        $meeting = $this->get($id);

        return view('meetings.show', compact('meeting'));
    }

    // public function join(Request $request)
    // {
    //     return redirect('meetings/meeting.html?' . $request->all());
    // }

    public function createMetting($jobSeeker, $employerJob, UserRepository $userRepo)
    {
        $this->userrepository = $userRepo;
        try {
            $job_seeker = $this->userrepository->find($jobSeeker, ['*'], true);

            if (empty($job_seeker)) {
                return $this->sendError('record not found');
            }
            $modal = view('meetings.create', ['job_seeker' => $job_seeker, 'employerJob' => $employerJob])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $createmeeting = $this->create($request->all());

            $input = [
                'topic' => $request->topic,
                'start_time' => $request->start_time,
                'duration' => $request->duration,
                'agenda' => $request->agenda,
                'host_video' => $request->host_video,
                'participant_video' => $request->participant_video,
                'jobseeker_id' => $request->jobseeker_id,
                'employer_job_id' => $request->employer_job_id,
                'start_url' => $createmeeting['data']['start_url'],
                'join_url' => $createmeeting['data']['join_url'],
                'password' => $createmeeting['data']['password'],
                'host_id' => $createmeeting['data']['host_id'],
                'main_id' => $createmeeting['data']['id'],
                'meeting_json' => json_encode($createmeeting)
            ];

            $save = ZoomMeeting::create($input);
            Flash::success('create meeting successfully.');
            return redirect()->back();
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function update($meeting, Request $request)
    {
        $this->update($meeting->zoom_meeting_id, $request->all());

        return redirect()->route('meetings.index');
    }
}
