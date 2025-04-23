<?php

namespace App\Http\Controllers\Front;

use App\DataTables\ApplicationTrackingDatatable;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Notifications\ApplicationStatusChange;
use App\Repositories\ApplyJobRepository;
use App\Repositories\UserRepository;
use App\Repositories\ApplicationTrackingRepository;
use App\Repositories\EmployerJobRepository;
use Laracasts\Flash\Flash;
use Response;
use Throwable;

class ApplicationTrackingController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $userrepository;
    public $applicationTrackingRepository;
    public $employerJobRepository;

    public function __construct(ApplyJobRepository $applyJobRepository, UserRepository $userRepository, ApplicationTrackingRepository $applicationTrackingRepo, EmployerJobRepository $employerJobRepo)
    {
        $this->repository = $applyJobRepository;
        $this->employerJobRepository = $employerJobRepo;
        $this->userrepository = $userRepository;
        $this->applicationTrackingRepository = $applicationTrackingRepo;
        $this->getEntity('applicationTrackings');
    }

    /**
     * Display a listing of the .
     *
     * @param ApplicationTrackingDatatable $ApplicationTrackingDatatable
     * @return Response
     */
    public function index(ApplicationTrackingDatatable $applicationTrackingDatatable, $employer_job_id)
    {
        $employerJob = $this->employerJobRepository->find($employer_job_id, ['*'], true);

        return $applicationTrackingDatatable->render($this->entity['view'] . '.index', ['employer_job_id' => $employer_job_id, 'entity' => $this->entity, 'employerJob' => $employerJob]);
    }

    public function actions($id)
    {
        try {
            $candidate = $this->userrepository->find($id, ['*'], true);

            if (empty($candidate)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }
            $modal = view($this->entity['view'] . '.actions', ['entity' => $this->entity, 'candidate' => $candidate])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function actionssave(Request $request)
    {
        $input = $request->all();

        $application = $this->applicationTrackingRepository->updateOrCreate($input['user_id'], $input);

        Flash::success($this->entity['singular'] . ' Status Change Successfully');

        return redirect()->back();
    }

    public function questionnaire($id)
    {
        try {
            $appliedJob = $this->repository->find($id, ['*'], true);

            if (empty($appliedJob)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }
            $modal = view($this->entity['view'] . '.questionnaire', ['entity' => $this->entity, 'appliedJob' => $appliedJob])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function ajaxStatus(Request $request)
    {
        try {
            $jobApplication = $this->repository->find($request->id);

            if (empty($jobApplication)) {
                Flash::error($this->entity['singular'] . ' not found');
                return redirect(route($this->entity['url'] . '.index', $request->id));
            }
            $old_status = $jobApplication->status;
            $statuses = config('constants.candidate_status');

            $jobApplication = $this->repository->update($request->all(), $jobApplication->id, true);

            // notify to Candidate
            $jobApplication->user->notify(new ApplicationStatusChange($jobApplication));

            $modal = view('components.candidate_status', ['statuses' => $statuses, 'id' => $jobApplication->id, 'selected' => $jobApplication->status])->render();
            $selected_class = str_replace(" ", "_", strtolower($jobApplication->status));
            $old_class = str_replace(" ", "_", strtolower($old_status));
            return $this->sendResponse(['callbackFunction' => "$('.select_status_".$jobApplication->id."').removeClass('".$old_class."');$('.select_status_".$jobApplication->id."').addClass('".$selected_class."');"], 'Status Updated Successfully');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
