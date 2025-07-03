<?php

namespace App\Http\Controllers\Admin;

use App\Classes\NotifyCandidate;
use App\DataTables\JobPostingDataTable;
use App\Http\Requests\UpdatePackageRequest;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateEmployerJobRequest;
use App\Http\Requests\CreateJobPostRequest;
use App\Http\Requests\UpdateEmployerJobRequest;
use App\Notifications\JobStatusChange;
use App\Notifications\JobStatusChangeEmployer;
use App\Repositories\ApplyJobRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\EmployerJobCertificateRepository;
use App\Repositories\EmployerJobQualificationRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\EmployerJobSkillRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\UserRepository;
use App\Repositories\WorkTypeRepository;
use Illuminate\Http\Request;
use Response;
use Throwable;

class JobPostController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $userProfileRepo;
    public $userRepository;
    public $employerJobSkillRepository;
    public $employerJobQualificationRepository;
    public $employerJobCertificateRepository;
    private $questionnaireRepository;
    public $documentRepository;
    private $jobSeekerDetailRepository;
    private $workTypeRepository;
    private $disk = 'employerJobs';

    public function __construct(EmployerJobRepository $employerJobRepo, UserRepository $userRepo, EmployerJobSkillRepository $employerJobSkillRepo, EmployerJobQualificationRepository $employerJobQualificationRepo, EmployerJobCertificateRepository $employerJobCertificateRepo, DocumentRepository $documentRepo, QuestionnaireRepository $questionnaireRepo, JobSeekerDetailRepository $jobSeekerDetailRepo, ApplyJobRepository $applyJobRepo,WorkTypeRepository $workTypeRepository)
    {
        $this->repository = $employerJobRepo;
        $this->userRepository = $userRepo;
        $this->employerJobSkillRepository = $employerJobSkillRepo;
        $this->employerJobQualificationRepository = $employerJobQualificationRepo;
        $this->employerJobCertificateRepository = $employerJobCertificateRepo;
        $this->questionnaireRepository = $questionnaireRepo;
        $this->jobSeekerDetailRepository = $jobSeekerDetailRepo;
        $this->applyJobRepository = $applyJobRepo;
        $this->getEntity();
        $this->documentRepository = $documentRepo;
        $this->workTypeRepository = $workTypeRepository;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the Job.
     *
     * @param JobPostingDataTable $jobPostingDataTable
     * @return Response
     */
    public function index(JobPostingDataTable $jobPostingDataTable)
    {
        return $jobPostingDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Job.
     *
     * @return Response
     */
    public function create()
    {
        try {
            $workTypes = $this->workTypeRepository->all()->pluck('title', 'id')->toArray();

            return view($this->entity['view'] . '.create', ['entity' => $this->entity,'workType' => $workTypes]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param CreateJobPostRequest $request
     *
     * @return Response
     */
    public function store(CreateJobPostRequest $request)
    {
        try {
            $input = $request->all();

            // Set default meta values if not provided
            $input['meta_title'] = $input['meta_title'] ?? '';
            $input['meta_description'] = $input['meta_description'] ?? '';

            $job = $request->except('skill_id', 'certification_id', 'qualification_id');
            $job['is_featured'] = $request->get('is_featured', null) != null ? 1 : 0;
            $employerJob = $this->repository->create($job);

            // logo
            $logo = $request->get('employer_job_logo', []);
            $doc_type = config('constants.document_type.cropped_images', 2);
            $this->documentRepository->savePermanent($logo, $doc_type, $employerJob);

            //assign skill to emploerjob
            $skills = isset($input['skill_id']) ? $input['skill_id'] : [];
            $this->employerJobSkillRepository->syncBySkill($skills, $employerJob);

            //assign qualification to emploerjob
            $qualifications = isset($input['qualification_id']) ? $input['qualification_id'] : [];
            $this->employerJobQualificationRepository->syncByQualification($qualifications, $employerJob);

            //assign certificate to emploerjob
            $certifications = isset($input['certification_id']) ? $input['certification_id'] : [];
            $this->employerJobCertificateRepository->syncByCertification($certifications, $employerJob);

            // add/update questionnaire
            $questionnaire = isset($input['questionnaire']) ? $input['questionnaire'] : [];
            $this->questionnaireRepository->sync($questionnaire, $employerJob->id);

            // Flash::success($this->entity['singular'] . ' updated successfully.');
            $jobseekerIds = $this->jobSeekerDetailRepository->getJobseekerIds($employerJob);

            (new NotifyCandidate($jobseekerIds, $employerJob, 'JobAlertNotification'))->notify();

            return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_success' => $this->entity['singular'] . ' saved successfully.']);
        } catch (Throwable $e) {
            // throw $e;
            // Flash::error($e->getMessage());
            $input = $request->all() + ['toast_error' => $e->getMessage()];
            return redirect()->back()->withInput($input);
        }
    }

    /**
     * Display the specified Job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $job = $this->repository->find($id, ['*'], true);

            if (empty($job)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['job' => $job, 'entity' => $this->entity,'id' => $id]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Package.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $employerJob = $this->repository->find($id, ['*'], true);
            $workTypes = $this->workTypeRepository->all()->pluck('title', 'id')->toArray();

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }
            //dd($this->entity['view']);
            return view($this->entity['view'] . '.edit', ['employerJob' => $employerJob, 'entity' => $this->entity, 'imageModel' => $employerJob,'workType' => $workTypes]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Package in storage.
     *
     * @param  int              $id
     * @param UpdatePackageRequest $request
     *
     * @return Response
     */
    public function update($id, CreateJobPostRequest $request)
    {
        try {
            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $input = $request->all();

            // Set default meta values if not provided
            $input['meta_title'] = $input['meta_title'] ?? '';
            $input['meta_description'] = $input['meta_description'] ?? '';




            $job = $request->except('skill_id', 'certification_id', 'qualification_id');
            $job['is_featured'] = $request->get('is_featured', null) != null ? 1 : 0;
            $employerJob = $this->repository->update($job, $id, true);

            // logo
            $logo = $request->get('employer_job_logo', []);
            $doc_type = config('constants.document_type.cropped_images', 2);
            $this->documentRepository->savePermanent($logo, $doc_type, $employerJob);

            //assign skill to employer jobs
            $skills = isset($input['skill_id']) ? $input['skill_id'] : [];
            $this->employerJobSkillRepository->syncBySkill($skills, $employerJob);

            //assign qualification to employer jobs
            $qualifications = isset($input['qualification_id']) ? $input['qualification_id'] : [];
            $this->employerJobQualificationRepository->syncByQualification($qualifications, $employerJob);

            //assign certificate to emploerjob
            $certifications = isset($input['certification_id']) ? $input['certification_id'] : [];
            $this->employerJobCertificateRepository->syncByCertification($certifications, $employerJob);

            // add/update questionnaire
            $questionnaire = isset($input['questionnaire']) ? $input['questionnaire'] : [];
            $this->questionnaireRepository->sync($questionnaire, $employerJob->id);

            if ($input['approve_job']) {
                $input['status'] = 1;
                $input['apporval_reason'] = '';
                $status = config("constants.approval_status.data.{$input['status']}", null);
                $this->repository->approvalStatusChange($employerJob, $input);
                $employerJob->createdByUser->notify(new JobStatusChangeEmployer($employerJob, $status));
                Flash::success($this->entity['singular'] . ' updated and approved successfully.');
            } else {
                Flash::success($this->entity['singular'] . ' updated successfully.');
            }



            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function isFeatureUpdate(Request $request)
    {
        try {
            $employerJob = $this->repository->find($request->id, ['*'], true);
            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $employerJob = $this->repository->update($request->all(), $employerJob->id, true);
            // dd($employerJob);
            return $this->sendResponse(['callbackFunction' => 'void(0);'], 'Is Featured updated successfully.');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function editJobApproval($id, Request $request)
    {
        try {
            $input = $request->all();

            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {

                $modal = view($this->entity['view'] . '.edit_job_approval', ['employerJob' => $employerJob, 'entity' => $this->entity, 'status' => $input['status']])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function updateJobApproval(Request $request)
    {
        $requested_data = $request->all();
        $employerJob = $this->repository->find($requested_data['id'], ['*'], true);
        if (empty($employerJob)) {
            return $this->sendError($this->entity['singular'] . ' not found');
        }
        $status = config("constants.approval_status.data.{$requested_data['status']}", null);
        $this->repository->approvalStatusChange($employerJob, $requested_data);
        $employerJob->createdByUser->notify(new JobStatusChangeEmployer($employerJob, $status));
        return $this->sendResponse($employerJob, 'Status updated successfully');
    }
}
