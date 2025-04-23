<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InterviewTypeDataTable;
use App\Http\Requests\CreateInterviewTypeRequest;
use App\Http\Requests\UpdateInterviewTypeRequest;
use App\Repositories\InterviewTypeRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class InterviewTypeController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(InterviewTypeRepository $interviewTypeRepo)
    {
        $this->repository = $interviewTypeRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the InterviewType.
     *
     * @param InterviewTypeDataTable $interviewTypeDataTable
     * @return Response
     */
    public function index(InterviewTypeDataTable $interviewTypeDataTable)
    {
        return $interviewTypeDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
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
     * Store a newly created InterviewType in storage.
     *
     * @param CreateInterviewTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateInterviewTypeRequest $request)
    {
        try {
            $input = $request->all();

            $interviewType = $this->repository->create($input);

            return $this->sendResponse($interviewType, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified InterviewType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $interviewType = $this->repository->find($id, ['*'], true);

            if (empty($interviewType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['interviewType' => $interviewType, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified InterviewType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $interviewType = $this->repository->find($id, ['*'], true);

            if (empty($interviewType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['interviewType' => $interviewType, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified InterviewType in storage.
     *
     * @param  int              $id
     * @param UpdateInterviewTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInterviewTypeRequest $request)
    {
        try {
            $interviewType = $this->repository->find($id, ['*'], true);

            if (empty($interviewType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $interviewType = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($interviewType, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
