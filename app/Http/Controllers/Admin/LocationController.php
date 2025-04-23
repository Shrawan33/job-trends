<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LocationDatatable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Imports\StateDistrictImport;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Throwable;

class LocationController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->repository = $locationRepository;
        $this->getEntity();
    }

    /**
     * Display a listing of the Location.
     *
     * @param LocationDatatable $locationDatatable
     * @return Response
     */
    public function index(LocationDatatable $locationDatatable)
    {
        return $locationDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new InterviewType.
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
     * Store a newly created location in storage.
     *
     * @param CreateLocationRequest $request
     *
     * @return Response
     */
    public function store(CreateLocationRequest $request)
    {
        try {
            $input = $request->all();

            $location = $this->repository->create($input);

            return $this->sendResponse($location, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified location.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $location = $this->repository->find($id, ['*'], true);

            if (empty($location)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['location' => $location, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified location.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $location = $this->repository->find($id, ['*'], true);

            if (empty($location)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['location' => $location, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified location in storage.
     *
     * @param  int              $id
     * @param UpdateLocationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLocationRequest $request)
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
