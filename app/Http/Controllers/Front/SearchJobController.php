<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\CreateEmployerJobRequest;
use App\Http\Requests\UpdateEmployerJobRequest;
use App\Repositories\EmployerJobRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\EmployerJobSkillRepository;
use App\Repositories\LocationRepository;
use App\Repositories\UserRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CountryRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\SkillRepository;
use App\Repositories\StateRepository;
use App\Repositories\WorkTypeRepository;
use Illuminate\Http\Request;
use Response;
use Throwable;

class SearchJobController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $categoryRepo;
    public $locationRepo;
    public $userProfileRepo;
    public $UserRepository;
    public $employerJobSkillRepository;
    public $stateRepository, $countryRepository, $skillRepository, $workTypeRepository, $experienceRepository;

    public function __construct(EmployerJobRepository $employerJobRepo, CategoryRepository $CategoryRepo, UserRepository $UserRepo, EmployerJobSkillRepository $EmployerJobSkillRepo, LocationRepository $locationRepository, StateRepository $stateRepo, CountryRepository $countryRepo, SkillRepository $skillRepo, WorkTypeRepository $workTypeRepo, ExperienceRepository $experienceRepo)
    {
        $this->repository = $employerJobRepo;
        $this->categoryRepo = $CategoryRepo;
        $this->UserRepository = $UserRepo;
        $this->employerJobSkillRepository = $EmployerJobSkillRepo;
        $this->locationRepo = $locationRepository;
        $this->stateRepository = $stateRepo;
        $this->countryRepository = $countryRepo;
        $this->skillRepository = $skillRepo;
        $this->workTypeRepository = $workTypeRepo;
        $this->experienceRepository = $experienceRepo;
        $this->getEntity('search-jobs');
    }

    /**
     * Display a listing of the EmployerJob.
     *
     * @param EmployerJobDataTable $employerJobDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $totalJobs = $this->repository->search($request->all());
        $input = $request->input();

        if ($request->ajax()) {
            return $this->sendResponse(view($this->entity['view'] . '.list-job', compact('totalJobs'))->render(), '');
        } else {
            return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'totalJobs' => $totalJobs, 'input' => $input]);
        }
    }

    public function categorySearch($slug, Request $request)
    {
        $totalJobs = $this->repository->search($request->all(), $slug);


        $input = $request->input();

        if ($request->ajax()) {
            return $this->sendResponse(view($this->entity['view'] . '.list-job', compact('totalJobs'))->render(), '');
        // return $this->sendResponse($modal, '');
        } else {
            return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'totalJobs' => $totalJobs, 'slug' => $slug, 'input' => $input]);
        }
    }

    /**
     * Show the form for creating a new EmployerJob.
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

    /**
     * Store a newly created EmployerJob in storage.
     *
     * @param CreateEmployerJobRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployerJobRequest $request)
    {
        try {
            $input = $request->all();

            $employerJob = $this->repository->create($input);
            //assign skill to emploerjob
            $skills = isset($input['skill_id']) ? $input['skill_id'] : [];
            // dd($skills);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified EmployerJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $employerJob = $this->repository->find($id, ['*'], true);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['employerJob' => $employerJob, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified EmployerJob.
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
     * Update the specified EmployerJob in storage.
     *
     * @param  int              $id
     * @param UpdateEmployerJobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployerJobRequest $request)
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
            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function ajaxSubcategories(Request $request)
    {
        // dd($request->all());
        $category_id = $request->get('parent_id', '');

        $limit = config('constants.default_dd_limit', null);
        $search = ['name' => $request->get('term', ''), 'parent_id' => $category_id];
        $exclude = $request->get('exclude', null);
        $data = $this->categoryRepo->all($search, null, $limit, ['id', 'title', 'title as text'], [], [], ['id' => $exclude]);
        return response()->json(['results' => $data]);
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $totalJobs = [];
        $input = [];

        if (!empty($request->all())) {
            $totalJobs = $this->repository->search($request->all());
            $input = $request->input();
        }
        if ($request->ajax()) {
            return $this->sendResponse(view($this->entity['view'] . '.list-job', compact('totalJobs'))->render(), '');
            // return $this->sendResponse($modal, '');
        }

        // $modal = view($this->entity['view'] . '.list-job', ['entity' => $this->entity, 'totalJobs' => $totalJobs, 'input' => $input])->render();

        // return $this->sendResponse($modal, '');
    }

    public function ajaxLocations(Request $request)
    {
        // dd($request->all());
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];
        $parent = $request->get('parent_id', null);
        if (!empty($parent)) {
            $search['state_id'] = $parent;
        }
        $data = $this->locationRepo->all($search, null, $limit, ['id', 'title', 'title as text'], [], ['title' => 'ASC']);
        return response()->json(['results' => $data]);
    }

    public function ajaxStates(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];
        $parent = $request->get('parent_id', null);
        // dd($parent);

        if (!empty($parent)) {
            $search['country_id'] = $parent;
        }

        $data = $this->stateRepository->all($search, null, $limit, ['id', 'title', 'title as text'], [], ['title' => 'ASC']);
        return response()->json(['results' => $data]);
    }

    public function ajaxCountries(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['name' => $request->get('term', '')];
        $data = $this->countryRepository->all($search, null, $limit, ['id', 'name', 'name as text'], [], ['name' => 'ASC']);
        return response()->json(['results' => $data]);
    }

    public function ajaxCategories(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];

        $data = $this->categoryRepo->all($search, null, $limit, ['id', 'title', 'title as text']);
        return response()->json(['results' => $data]);
    }

    public function ajaxSkill(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];

        $data = $this->skillRepository->all($search, null, $limit, ['id', 'title', 'title as text']);
        return response()->json(['results' => $data]);
    }

    public function workType(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];

        $data = $this->workTypeRepository->all($search, null, $limit, ['id', 'title', 'title as text']);
        return response()->json(['results' => $data]);
    }

    public function experience(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];

        $data = $this->experienceRepository->all($search, null, $limit, ['id', 'title', 'title as text']);
        return response()->json(['results' => $data]);
    }

}
