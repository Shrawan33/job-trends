<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExperienceDataTable;
use App\Http\Requests\CreateExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Repositories\ExperienceRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class ExperienceController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(ExperienceRepository $experienceRepo)
    {
        $this->repository = $experienceRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Experience.
     *
     * @param ExperienceDataTable $experienceDataTable
     * @return Response
     */
    public function index(ExperienceDataTable $experienceDataTable)
    {
        return $experienceDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Experience.
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
     * Store a newly created Experience in storage.
     *
     * @param CreateExperienceRequest $request
     *
     * @return Response
     */
    public function store(CreateExperienceRequest $request)
    {
        try {
            $input = $request->all();

            $experience = $this->repository->create($input);

            return $this->sendResponse($experience, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Experience.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $experience = $this->repository->find($id, ['*'], true);

            if (empty($experience)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['experience' => $experience, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Experience.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $experience = $this->repository->find($id, ['*'], true);

            if (empty($experience)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['experience' => $experience, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Experience in storage.
     *
     * @param  int              $id
     * @param UpdateExperienceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExperienceRequest $request)
    {
        try {
            $experience = $this->repository->find($id, ['*'], true);

            if (empty($experience)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $experience = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($experience, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
