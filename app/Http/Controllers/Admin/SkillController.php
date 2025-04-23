<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SkillDataTable;
use App\Http\Requests\CreateSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Repositories\SkillRepository;
use App\Http\Controllers\AppBaseController;
use App\Imports\SkillSheetmport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Throwable;

class SkillController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(SkillRepository $skillRepo)
    {
        $this->repository = $skillRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Skill.
     *
     * @param SkillDataTable $skillDataTable
     * @return Response
     */
    public function index(SkillDataTable $skillDataTable)
    {
        return $skillDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Skill.
     *
     * @return Response
     */
    public function create()
    {
        try {
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created Skill in storage.
     *
     * @param CreateSkillRequest $request
     *
     * @return Response
     */
    public function store(CreateSkillRequest $request)
    {
        try {
            $input = $request->all();

            $skill = $this->repository->create($input);

            return $this->sendResponse($skill, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Skill.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $skill = $this->repository->find($id, ['*'], true);

            if (empty($skill)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['skill' => $skill, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Skill.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $skill = $this->repository->find($id, ['*'], true);

            if (empty($skill)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['skill' => $skill, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Skill in storage.
     *
     * @param  int              $id
     * @param UpdateSkillRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSkillRequest $request)
    {
        try {
            $skill = $this->repository->find($id, ['*'], true);

            if (empty($skill)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $skill = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($skill, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function getImportfile()
    {
        $modal = view($this->entity['view'] . '.import')->render();

        return $this->sendResponse($modal, '');
    }

    public function import(Request $request)
    {
        if ($request->file('import_file') ?? false) {
            Excel::import(new SkillSheetmport, $request->file('import_file'));
            return $this->sendResponse([], 'Import successfully.');
        } else {
            return $this->sendError($this->entity['singular'] . ' import file not found');
        }
    }
}
