<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LevelDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Repositories\LevelRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class LevelController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(LevelRepository $levelRepo)
    {
        $this->repository = $levelRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Level.
     *
     * @param LevelDataTable $levelDataTable
     * @return Response
     */
    public function index(LevelDataTable $levelDataTable)
    {
        return $levelDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Level.
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
     * Store a newly created Level in storage.
     *
     * @param CreateLevelRequest $request
     *
     * @return Response
     */
    public function store(CreateLevelRequest $request)
    {
        try {
            $input = $request->all();
            $level = $this->repository->create($input);
            return $this->sendResponse($level, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Level.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $level = $this->repository->find($id, ['*'], true);

            if (empty($level)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['level' => $level, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Level.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $level = $this->repository->find($id, ['*'], true);

            if (empty($level)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['level' => $level, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Level in storage.
     *
     * @param  int              $id
     * @param UpdateLevelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLevelRequest $request)
    {
        try {
            $level = $this->repository->find($id, ['*'], true);

            if (empty($level)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $level = $this->repository->update($request->all(), $id, true);
                return $this->sendResponse($level, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
