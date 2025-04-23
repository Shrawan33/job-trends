<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecializationDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Repositories\SpecializationRepository;
use Throwable;

class SpecializationController extends AppBaseController
{
    public $repository;

    public function __construct(SpecializationRepository $specializationRepo)
    {
        $this->repository = $specializationRepo;
        $this->getEntity();
    }

    public function index(SpecializationDataTable $specializationDataTable)
    {
        // dd($specializationDataTable);
        return $specializationDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    public function create()
    {
        try {
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity])->render();
            // dd($modal);
            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e-> getMessage(), $e->getCode() ?: 400);
        }
    }

    public function store(CreateSpecializationRequest $request)
    {
        try {
            $input = $request->validated();
            $specialization = $this->repository->create($input);
            // dd($specialization);
            return $this->sendResponse($specialization, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() ?: 400);
        }
    }

    public function show($id)
    {
        try {
            $specialization = $this->repository->find($id, ['*'], true);
            if (empty($specialization)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['specialization' => $specialization, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() ?: 400);
        }
    }

    public function edit($id)
    {
        try {
            $specialization = $this->repository->find($id, ['*'], true);
            if (empty($specialization)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['specialization' => $specialization, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() ?: 400);
        }
    }

    public function update($id, UpdateSpecializationRequest $request)
    {
        try {
            $specialization = $this->repository->find($id, ['*'], true);
            if (empty($specialization)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $specialization = $this->repository->update($request->validated(), $id, true);
                return $this->sendResponse($specialization, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() ?: 400);
        }
    }
}

