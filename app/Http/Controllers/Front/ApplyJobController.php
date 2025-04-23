<?php

namespace App\Http\Controllers\Front;

use App\DataTables\ApplyJobDatatable;
use App\Repositories\ApplyJobRepository;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateApplyJobRequest;
use App\Notifications\JobApplication;
use App\Repositories\AppliedJobQuestionnaireRepository;
use App\Repositories\EmployerJobRepository;
use Illuminate\Support\Facades\Auth;
use Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class ApplyJobController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    private $employerJobRepository;
    private $appliedJobQuestionnaireRepo;

    public function __construct(ApplyJobRepository $applyJobRepo, EmployerJobRepository $employerJobRepo, AppliedJobQuestionnaireRepository $appliedJobQuestionnaireRepo)
    {
        $this->repository = $applyJobRepo;
        $this->employerJobRepository = $employerJobRepo;
        $this->appliedJobQuestionnaireRepo = $appliedJobQuestionnaireRepo;
        $this->getEntity('applyJobs');
    }

    /**
     * Display a listing of the ApplyJob.
     *
     * @param ApplyJobDataTable $ApplyJobDataTable
     * @return Response
     */
    public function index(ApplyJobDatatable $applyJobDatatable)
    {
        // dd($applyJobDatatable);
        return $applyJobDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new ApplyJob.
     *
     * @return Response
     */
    public function create($job_id)
    {
        try {
            $inCompleteProfile = auth()->user()->isProfileComplete();

            if ($inCompleteProfile['incompleteSections'] !== true) {
                return $this->sendError(trans('message.incomplete_profile_apply_job'), 200);
            }

            $employerJob = $this->employerJobRepository->find($job_id);

            if (empty($employerJob)) {
                return $this->sendError(trans('job_not_found'));
            }

            $modal = view($this->entity['view'] . '.create', [
                'entity' => $this->entity,
                'job_id' => $job_id,
                'questionnaire' => $employerJob->questionnaire
            ])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created ApplyJob in storage.
     *
     * @param CreateEmployerJobRequest $request
     *
     * @return Response
     */
    public function store(CreateApplyJobRequest $request, $job_id)
    {
        try {
            $inCompleteProfile = auth()->user()->isProfileComplete();

            if ($inCompleteProfile['incompleteSections'] !== true) {
                return $this->sendError(trans('message.incomplete_profile_apply_job'), 200);
            }

            $employerJob = $this->employerJobRepository->find($job_id);

            if (empty($employerJob)) {
                return $this->sendError(trans('job_not_found'));
            }

            $input = $request->all();

            throw_if(!empty(auth()->user()) && auth()->user()->id != $request->get('user_id', 0), BadRequestException::class, 'You are not authorized to access this action');

            $applied = $this->repository->all(['user_id' => $request->get('user_id', 0), 'employer_job_id' => $job_id]);
            throw_if($applied->count() > 0, BadRequestException::class, 'You have already applied for the requested job');

            $input['employer_job_id'] = $job_id;
            $input['status'] = 'Awaiting Review'; // Set the status to 'Awaiting Review'
            $applyjob = $this->repository->create($input);

            // save answer from questionnaire
            $questionnaire = isset($input['questionnaire']) ? $input['questionnaire'] : [];
            $this->appliedJobQuestionnaireRepo->sync($questionnaire, $applyjob->id);

            $applyjob->refreshContentId = 'employer_job_actions';
            $applyjob->refreshContent = view('components.jobs.action_buttons', ['job' => $applyjob->employerJob])->render();
            // notify to employer
            $applyjob->createdByUser->notify(new JobApplication($applyjob));
             $applyjob->employerJob->createdByUser->notify(new JobApplication($applyjob));

            $applyjob->successURL = route('thank_you', ['slug' => $applyjob->employerJob->slug]);
            /*$applyjob->refreshContentId = 'job-display-action';
            $applyjob->refreshContent = view('components.jobs.action_buttons', ['job' => $applyjob->employerJob])->render();*/
            //return redirect()->route('thank_you', ['slug' => $applyjob->employerJob->slug]);
            return $this->sendResponse($applyjob, trans('message.applied_successfully'));
        } catch (Throwable $e) {
            // throw $e;
            return $this->sendError($e->getMessage(), 400);
        }
    }



    /**
     * Display the specified ApplyJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $applyJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['applyJob' => $applyJob, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified ApplyJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['employerJob' => $employerJob, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified ApplyJob in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        try {
            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }
            // dd($request->all());
            $employerJob = $this->repository->update($request->all(), $id, true);
            //assign skill to employer jobs
            $input = $request->all();
            $skills = isset($input['skill_id']) ? $input['skill_id'] : [];
            $this->employerJobSkillRepository->syncBySkill($skills, $employerJob->id);
            Flash::success($this->entity['singular'] . ' Updated Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
    public function thank_you($slug)
    {
        $employerJob = $this->employerJobRepository->find($slug, ['*'], true, true);

        return view('components.jobs.thank_you', ['employerJob' => $employerJob]);
    }

}
