<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WorkTypeDataTable;
use App\Http\Requests\CreateWorkTypeRequest;
use App\Http\Requests\UpdateWorkTypeRequest;
use App\Repositories\WorkTypeRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class WorkTypeController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(WorkTypeRepository $workTypeRepo)
    {
        $this->repository = $workTypeRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the WorkType.
     *
     * @param WorkTypeDataTable $workTypeDataTable
     * @return Response
     */
    public function index(WorkTypeDataTable $workTypeDataTable)
    {
        return $workTypeDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new WorkType.
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
     * Store a newly created WorkType in storage.
     *
     * @param CreateWorkTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateWorkTypeRequest $request)
    {
        try {
            $input = $request->all();

            $workType = $this->repository->create($input);

            return $this->sendResponse($workType, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified WorkType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $workType = $this->repository->find($id);

            if (empty($workType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['workType' => $workType, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified WorkType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $workType = $this->repository->find($id);

            if (empty($workType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['workType' => $workType, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified WorkType in storage.
     *
     * @param  int              $id
     * @param UpdateWorkTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorkTypeRequest $request)
    {
        try {
            $workType = $this->repository->find($id);

            if (empty($workType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $workType = $this->repository->update($request->all(), $id);

                return $this->sendResponse($workType, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
