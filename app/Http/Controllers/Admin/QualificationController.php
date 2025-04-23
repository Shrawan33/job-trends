<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\QualificationDataTable;
use App\Http\Requests\CreateQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Repositories\QualificationRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class QualificationController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(QualificationRepository $qualificationRepo)
    {
        $this->repository = $qualificationRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Qualification.
     *
     * @param QualificationDataTable $qualificationDataTable
     * @return Response
     */
    public function index(QualificationDataTable $qualificationDataTable)
    {
        return $qualificationDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Qualification.
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
     * Store a newly created Qualification in storage.
     *
     * @param CreateQualificationRequest $request
     *
     * @return Response
     */
    public function store(CreateQualificationRequest $request)
    {
        try {
            $input = $request->all();

            $qualification = $this->repository->create($input);

            return $this->sendResponse($qualification, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Qualification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $qualification = $this->repository->find($id, ['*'], true);

            if (empty($qualification)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['qualification' => $qualification, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Qualification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $qualification = $this->repository->find($id, ['*'], true);

            if (empty($qualification)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['qualification' => $qualification, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Qualification in storage.
     *
     * @param  int              $id
     * @param UpdateQualificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQualificationRequest $request)
    {
        try {
            $qualification = $this->repository->find($id, ['*'], true);

            if (empty($qualification)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $qualification = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($qualification, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
