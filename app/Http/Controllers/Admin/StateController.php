<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StateDataTable;
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Repositories\StateRepository;
use App\Http\Controllers\AppBaseController;
use App\Imports\StateDistrictImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Throwable;

class StateController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->repository = $stateRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the State.
     *
     * @param StateDataTable $stateDataTable
     * @return Response
     */
    public function index(StateDataTable $stateDataTable)
    {
        return $stateDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new State.
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
     * Store a newly created State in storage.
     *
     * @param CreateStateRequest $request
     *
     * @return Response
     */
    public function store(CreateStateRequest $request)
    {
        try {
            $input = $request->all();

            $state = $this->repository->create($input);

            return $this->sendResponse($state, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified State.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $state = $this->repository->find($id, ['*'], true);

            if (empty($state)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['state' => $state, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $state = $this->repository->find($id, ['*'], true);

            if (empty($state)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['state' => $state, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified State in storage.
     *
     * @param  int              $id
     * @param UpdateStateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStateRequest $request)
    {
        try {
            $location = $this->repository->find($id, ['*'], true);

            if (empty($location)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $location = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($location, $this->entity['singular'] . ' updated successfully.');
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
            Excel::import(new StateDistrictImport, $request->file('import_file'));
            return $this->sendResponse([], 'Import successfully.');
        } else {
            return $this->sendError($this->entity['singular'] . ' import file not found');
        }
    }
}
