<?php

namespace App\Http\Controllers\Front;

use App\DataTables\ResumeBuilderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateResumeBuilderRequest;
use App\Http\Requests\UpdateResumeBuilderRequest;
// use App\Repositories\ResumeBuilderControllerRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\JobSeekerDetail;
use App\Repositories\DocumentRepository;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\JobSeekerEducationRepository;
use App\Repositories\JobSeekerExperienceRepository;
use App\Repositories\JobSeekerLicenseRepository;
use App\Repositories\JobSeekerSkillRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;

class ResumeBuilderController extends AppBaseController
{
    /** @var  $repository */
    public $seekerdetailrepository;
    public $userProfileRepository;

    public $jobseekerDetailRepository;
    public $jobSeekerEducationRepository;
    public $jobSeekerExperienceRepository;
    public $jobSeekerSkillRepository;
    public $jobSeekerLicenseRepository;
    public $documentRepository;
    private $disk = 'user';

    public function __construct(JobSeekerDetailRepository $seekerdetailrepository, UserRepository $userRepo, JobSeekerDetailRepository $jobseekerDetailRepo, JobSeekerEducationRepository $jobSeekerEducationRepo, JobSeekerExperienceRepository $jobSeekerExperienceRepo, JobSeekerSkillRepository $jobSeekerSkillRepository, JobSeekerLicenseRepository $jobSeekerLicenseRepo, DocumentRepository $documentRepo)
    {
        $this->seekerdetailrepository = $seekerdetailrepository;
        $this->jobSeekerSkillRepository = $jobSeekerSkillRepository;
        $this->jobSeekerExperienceRepository = $jobSeekerExperienceRepo;
        $this->jobSeekerEducationRepository = $jobSeekerEducationRepo;
        $this->jobSeekerLicenseRepository = $jobSeekerLicenseRepo;
        // $this->getEntity();
        $this->getEntity(null, $this->disk);
        $this->documentRepository = $documentRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the ResumeBuilderController.
     *
     * @param ResumeBuilderDataTable $resum eBuilderDataTable
     * @return Response
     */
    public function index(ResumeBuilderDataTable $resumeBuilderDataTable)
    {
        return $resumeBuilderDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new ResumeBuilderController.
     *
     * @return Response
     */
    public function create()
    {
        try {
            return view($this->entity['view'] . '.create', ['entity' => $this->entity]);
        } catch (Throwable $e) {

            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function store(CreateResumeBuilderRequest $request)
    {
        try {
            $input = $request->except(['exp_id', 'company', 'role', 'location', 'from_month', 'duration_from', 'to_month', 'duration_to', 'years_known', 'description']);
            $userID = Auth::id(); // Get the user ID
            $input['user_id'] = $userID;
            $input['i_am_a'] = ''; // Set i_am_a field to an empty string
            $input['step'] = 2;
            $resumeBuilder = $this->seekerdetailrepository->create($input);
            return redirect()->route('resume-builder.editStep', ['userId' => $resumeBuilder->id, 'step' => 2]);
        } catch (Throwable $e) {
            dd($e);
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified ResumeBuilderController.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $resumeBuilderController = $this->repository->find($id, ['*'], true);

            if (empty($resumeBuilderController)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['resumeBuilderController' => $resumeBuilderController, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function editStep(Request $request, $userId, $step)
    {
        try {
            $seekerDetails = $this->seekerdetailrepository->find($userId, ['*'], true); // Retrieve user details based on $userId
            $imageModel = $this->seekerdetailrepository->makeModel();
            return view($this->entity['view'] . '.edit', [
                'entity' => $this->entity,
                'userId' => $userId, // Pass $userId to the view if required
                'seekerDetails' => $seekerDetails, // Pass the user details to the view if needed
                'step' => $step,
                'user' => Auth::user(),
                'imageModel' => $seekerDetails ?? $imageModel
            ]);
            return redirect()->back();
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function updateStep($id, UpdateResumeBuilderRequest $request)
    {
        // dd($request->all());
        try {

            $resumeBuilder = $this->seekerdetailrepository->find($id, ['*'], true);
            $step = $request->get('step', 1);
            if (empty($resumeBuilder)) {
                Flash::error($this->entity['singular'] . ' not found');
                return redirect(route($this->entity['url'] . '.index'));
            }

            if ($step == 1) {
                $resumeBuilder = $this->seekerdetailrepository->update($request->all(), $id, true);
                if ($resumeBuilder->exists()) {
                    $logo = $request->get('jobseeker_logo', []);
                    $doc_type = config('constants.document_type.image', 0);
                    $this->documentRepository->savePermanent($logo, $doc_type, $resumeBuilder);
                }
            } elseif ($step == 2) {
                $input['step'] = $step;
                $input['i_am_a'] = $request->get('i_am_a', null);
                $input['searching_for'] = $request->get('searching_for', null);


                $input['my_core_competencies'] = $request->get('my_core_competencies', null);
                $input['skill_id'] = $request->get('skill_id', null);
                $input['training_name'] = $request->get('training_name', null);
                $input['attended_at_company'] = $request->get('attended_at_company', null);
                $input['year'] = $request->get('year', null);
                $resumeBuilder = $this->seekerdetailrepository->update($input, $id, true);
            } elseif ($step == 3) {

                $input['resume_summary'] = $request->get('resume_summary', null);
                $input['experience_summary'] = $request->get('experience_summary', null);

                $resumeBuilder = $this->seekerdetailrepository->update($input, $id, true);

            }

            elseif ($step == 4) {
                $input['step'] = $step;
                $input['training_name'] = $request->get('training_name', null);
                $input['attended_at_company'] = $request->get('attended_at_company', null);
                $input['year'] = $request->get('year', null);
                $resumeBuilder = $this->seekerdetailrepository->update($input, $id, true);
            } else {
                $input['step'] = $step;
                $resumeBuilder = $this->seekerdetailrepository->update($input, $id, true);
            }

            if ($request->get('skill_id')) {
                $this->jobSeekerSkillRepository->syncSkill($request->all(), Auth::id(), $id);
            }

            if ($request->get('exp_id')) {
                //dd($request->all());
                $this->jobSeekerExperienceRepository->syncExperience($request->all(), Auth::id(), $id);
            }

            if ($request->get('edu_id')) {
                $this->jobSeekerEducationRepository->syncEducation($request->all(), Auth::id(), $id);
            }

            if ($request->get('lic_id')) {
                $this->jobSeekerLicenseRepository->syncLicense($request->all(), Auth::id(), $id);
            }

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect()->route('resume-builder.editStep', ['userId' => $resumeBuilder->id, 'step' => $step + 1]);
        } catch (Throwable $e) {
            dd($e);
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function edit()
    {
        try {
            $resumeBuilderController = $this->repository->find($id, ['*'], true);

            if (empty($resumeBuilderController)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['resumeBuilderController' => $resumeBuilderController, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            dD($e);
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified ResumeBuilderController in storage.
     *
     * @param  int              $id
     * @param UpdateResumeBuilderControllerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResumeBuilderRequest $request)
    {
        try {
            $resumeBuilderController = $this->repository->find($id, ['*'], true);

            if (empty($resumeBuilderController)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $resumeBuilderController = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            dd($e);
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function makePrimary($id)
    {
        $userId = Auth::id();
        $resumeBuilders = $this->seekerdetailrepository->all(['user_id' => $userId]);

        if (empty($resumeBuilders)) {
            Flash::error($this->entity['singular'] . ' not found');
            return redirect(route($this->entity['url'] . '.index'));
        }
        foreach ($resumeBuilders as $key => $resumeBuilder) {
            $this->seekerdetailrepository->update(['primary_account' => 0], $resumeBuilder->id, true);
        }
        $builder = $this->seekerdetailrepository->find($id);
        $update = $this->seekerdetailrepository->update(['primary_account' => 1], $id, true);
        Flash::success($this->entity['singular'] . ' updated successfully.');
        return redirect(route('resume-builder.index'));
    }
}
