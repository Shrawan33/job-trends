<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJobTypeRequest;
use App\Http\Requests\UpdateJobTypeRequest;
use App\Repositories\JobTypeRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class JobTypeController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(JobTypeRepository $jobTypeRepo)
    {
        $this->repository = $jobTypeRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the JobType.
     *
     * @param JobTypeDataTable $jobTypeDataTable
     * @return Response
     */
    public function index(JobTypeDataTable $jobTypeDataTable)
    {
        return $jobTypeDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new JobType.
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
     * Store a newly created JobType in storage.
     *
     * @param CreateJobTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateJobTypeRequest $request)
    {
        try {
            $input = $request->all();
            $jobType = $this->repository->create($input);
            return $this->sendResponse($jobType, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified JobType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $jobType = $this->repository->find($id, ['*'], true);

            if (empty($jobType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['jobType' => $jobType, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified JobType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $jobType = $this->repository->find($id, ['*'], true);

            if (empty($jobType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['jobType' => $jobType, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified JobType in storage.
     *
     * @param  int              $id
     * @param UpdateJobTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobTypeRequest $request)
    {
        try {
            $jobType = $this->repository->find($id, ['*'], true);

            if (empty($jobType)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $jobType = $this->repository->update($request->all(), $id, true);
            return $this->sendResponse($jobType, $this->entity['singular'] . ' saved successfully.');
            // Flash::success($this->entity['singular'] . ' updated successfully.');

            // return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        try {
            $jobType = $this->repository->find($id, ['*'], true);

            if (empty($jobType)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $jobType = $this->repository->update($request->all(), $id, true);
                return $this->sendResponse($jobType, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
