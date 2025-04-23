<?php

namespace App\Http\Controllers\Front;

use App\Classes\NotifyCandidate;
use App\DataTables\EmployerJobDataTable;
use App\DataTables\SearchJobDataTable;
use App\Http\Requests\CreateEmployerJobRequest;
use App\Http\Requests\UpdateEmployerJobRequest;
use App\Repositories\EmployerJobRepository;
use App\Repositories\EmployerJobSkillRepository;
use App\Repositories\EmployerJobQualificationRepository;
use App\Repositories\UserRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\EmployerJobWorkType;
use App\Models\Specialization;
use App\Notifications\JobEdit;
use App\Notifications\JobStatusChange;
use App\Repositories\ApplyJobRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\EmployerJobCertificateRepository;
use App\Repositories\EmployerJobWorkTypeRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\JobTypeRepository;
use App\Repositories\QuestionnaireRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use App\Models\User;
use Response;
use Throwable;

class EmployerJobController extends AppBaseController
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
    private $employerJobWorkTypeRepository;
    private $applyJobRepository;
    private $jobTypeRepository;

    private $disk = 'employerJobs';

    public function __construct(EmployerJobRepository $employerJobRepo, UserRepository $userRepo, EmployerJobSkillRepository $employerJobSkillRepo, EmployerJobQualificationRepository $employerJobQualificationRepo, EmployerJobCertificateRepository $employerJobCertificateRepo, DocumentRepository $documentRepo, QuestionnaireRepository $questionnaireRepo, JobSeekerDetailRepository $jobSeekerDetailRepo, ApplyJobRepository $applyJobRepo, EmployerJobWorkTypeRepository $employerJobWorkTypeRepo, JobTypeRepository $jobTypeRepo)
    {
        $this->repository = $employerJobRepo;

        $this->userRepository = $userRepo;
        $this->employerJobSkillRepository = $employerJobSkillRepo;
        $this->employerJobQualificationRepository = $employerJobQualificationRepo;
        $this->employerJobCertificateRepository = $employerJobCertificateRepo;
        $this->questionnaireRepository = $questionnaireRepo;
        $this->jobSeekerDetailRepository = $jobSeekerDetailRepo;
        $this->employerJobWorkTypeRepository = $employerJobWorkTypeRepo;
        $this->applyJobRepository = $applyJobRepo;
        $this->getEntity($this->disk);
        $this->documentRepository = $documentRepo;
        $this->jobTypeRepository = $jobTypeRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the EmployerJob.
     *
     * @param EmployerJobDataTable $employerJobDataTable
     * @return Response
     */
    public function index(EmployerJobDataTable $employerJobDataTable)
    {
        return $employerJobDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new EmployerJob.
     *
     * @return Response
     */
    public function create()
    {

        try {
            if (Configuration::getSessionConfigurationName(['general'], null, 'package_access')) {
                throw_if(empty(auth()->user()->activeUserPackage), UnauthorizedException::class, trans('message.no_active_package'));
            }
            return view($this->entity['view'] . '.create', ['entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function clone($id)
    {
        $this->getEntity($this->disk);

        return $this->edit($id, true);
    }

    /**
     * Store a newly created EmployerJob in storage.
     *
     * @param CreateEmployerJobRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployerJobRequest $request)
    {
        // dd($request);
        try {
            $input = $request->all();

            $job = $request->except('skill_id', 'certification_id', 'qualification_id');
            $job['is_featured'] = $request->get('is_featured', null) != null ? 1 : 0;
            $job['is_urgent'] = $request->get('is_urgent', null) != null ? 1 : 0;

            $job['category_id'] = $request->input('category_id');
            if (is_numeric($input['category_id']) === false && $input['category_id'] != '')
            {
                $job['category_id'] = Category::firstOrCreate(['title' => $input['category_id']])->id;
            }

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

            //assign work_type_id to jobseeker
            $workTypes = isset($input['work_type_id']) ? $input['work_type_id'] : [];
            $this->employerJobWorkTypeRepository->syncByWorkType($workTypes, $employerJob);

            // add/update questionnaire
            $questionnaire = isset($input['questionnaire']) ? $input['questionnaire'] : [];
            $this->questionnaireRepository->sync($questionnaire, $employerJob->id);

            // Flash::success($this->entity['singular'] . ' updated successfully.');
            $jobseekerIds = $this->jobSeekerDetailRepository->getJobseekerIds($employerJob);

            // $job_type = $this->jobTypeRepository->find($input['job_type_id'] ?: []);


            // if ($job_type['is_approval_needed'] == 0) {
            $job['status'] = 1;
            $job['apporval_reason'] = '';
            $this->repository->approvalStatusChange($employerJob, $job);
            $success_message = $this->entity['singular'] . ' Saved Successfully';
            // } else {

            //     $job_type->user->notify(new JobStatusChange($employerJob));
            //     $success_message = $this->entity['singular'] . ' saved successfully and under approval. You will get email notification once approval status updated';
            // }

            // (new NotifyCandidate($jobseekerIds, $employerJob, 'JobAlert'))->notify();

            return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_success' => $success_message]);
        } catch (Throwable $e) {
            throw $e;
            //Flash::error($e->getMessage());
            $input = $request->all() + ['toast_error' => $e->getMessage()];
            return redirect()->back()->withInput($input);
        }
    }

    /**
     * Display the specified EmployerJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($slug)
    {
        try {
            $employerJob = $this->repository->find($slug, ['*'], false, true);

            // restrict if employer has no active package or job doesn't exist
            $nUserRole = auth()->guest() || (auth()->user() && auth()->user()->hasRole('jobseeker')) ?: false;
            throw_if(empty($employerJob), ModelNotFoundException::class, trans('message.job_not_found'));
            // if (Configuration::getSessionConfigurationName(['general'], null, 'package_access')) {
            //     dd($employerJob, $slug,$employerJob->createdByUserWithActivePackage,$nUserRole);
            //     throw_if(($nUserRole && empty($employerJob->createdByUserWithActivePackage)), ModelNotFoundException::class, trans('message.job_not_found'));
            // }

            return view($this->entity['view'] . '.show', ['employerJob' => $employerJob, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            // Flash::error($e->getMessage());
            return redirect()->to('/')->withInput(['toast_error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified EmployerJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, $clone = false)
    {
        try {
            if (Configuration::getSessionConfigurationName(['general'], null, 'package_access')) {
                throw_if(empty(auth()->user()->activeUserPackage), UnauthorizedException::class, trans('message.no_active_package'));
            }
            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }
            if ($employerJob->created_by == Auth::id()) {
                return view($this->entity['view'] . '.edit', ['employerJob' => $employerJob, 'entity' => $this->entity, 'clone' => $clone, 'imageModel' => $employerJob]);
            } else {
                Flash::error('Access Denied..');
                return redirect()->back();
            }
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified EmployerJob in storage.
     *
     * @param  int              $id
     * @param UpdateEmployerJobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployerJobRequest $request)
    {
        // dd($request->all());
        try {
            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $input = $request->all();

            $job = $request->except('skill_id', 'certification_id', 'qualification_id');

            $job['is_featured'] = $request->get('is_featured', null) != null ? 1 : 0;
            $job['is_urgent'] = $request->get('is_urgent', null) != null ? 1 : 0;

            $job['category_id'] = $request->input('category_id');
            if (is_numeric($input['category_id']) === false && $input['category_id'] != '')
            {
                $job['category_id'] = Category::firstOrCreate(['title' => $input['category_id']])->id;
            }

            // $job['specialization_id'] = $request->input('specialization_id');
            // if (is_numeric($input['specialization_id']) === false)
            // {
            //     $job['specialization_id'] = Specialization::firstOrCreate(['name' => $input['specialization_id']])->id;
            // }
            // $job['specialization_id'] = $request->input('specialization_id');

            // if (isset($input['specialization_id']) && $input['specialization_id'] !== null) {
            //     if (is_numeric($input['specialization_id'])) {
            //         $job['specialization_id'] = $input['specialization_id'];
            //     } else {
            //         $specialization = Specialization::firstOrCreate(['name' => $input['specialization_id']]);
            //         $job['specialization_id'] = $specialization->id;
            //     }
            // } else {
            //     $job['specialization_id'] = null;
            // }

            // Save the $job object or perform further operations

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

            //assign work_type_id to jobseeker
            $workTypes = isset($input['work_type_id']) ? $input['work_type_id'] : [];
            $this->employerJobWorkTypeRepository->syncByWorkType($workTypes, $employerJob);

            // add/update questionnaire
            $questionnaire = isset($input['questionnaire']) ? $input['questionnaire'] : [];
            $this->questionnaireRepository->sync($questionnaire, $employerJob->id);
            $success_message = $this->entity['singular'] . ' Updated Successfully';


            $jobApplicants = $employerJob->applyJob()
                ->with('userWithoutHiddenProfile') // Assuming this filters users properly
                ->get();
                // Send email notifications to each applicant
                foreach ($jobApplicants as $applyJob) {
                // dd($applyJob->status);
                $applicant = $applyJob->userWithoutHiddenProfile; // Assuming 'userWithoutHiddenProfile' is the relationship to the User model
                if($applyJob->status == 'Awaiting Review')
                {
                $applicant->notify(new JobEdit($employerJob));
                }
            }
            // Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_success' => $success_message]);;
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function search(SearchJobDataTable $searchJobDataTable)
    {
        return $searchJobDataTable->render($this->entity['view'] . '.search-jobs', ['entity' => $this->entity]);
    }

    public function viewEmployer($slug)
    {
        try {
            $employer = $this->userRepository->find($slug, ['*'], false, true);

            $jobs = $this->repository->all(['created_by' => $employer->id]);
            return view($this->entity['view'] . '.employer.view', ['employer' => $employer, 'jobs' => $jobs]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
}
