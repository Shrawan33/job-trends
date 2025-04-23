<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CriteriaDataTable;
use App\Http\Requests\CreateCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\Repositories\CriteriaRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CriteriaLevelRepository;
use Response;
use Throwable;

class CriteriaController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $criteriaLevelRepository;

    public function __construct(CriteriaRepository $criteriaRepo, CriteriaLevelRepository $criteriaLevelRepo)
    {
        $this->repository = $criteriaRepo;
        $this->criteriaLevelRepository = $criteriaLevelRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Criteria.
     *
     * @param CriteriaDataTable $criteriaDataTable
     * @return Response
     */
    public function index(CriteriaDataTable $criteriaDataTable)
    {
        return $criteriaDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Criteria.
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
     * Store a newly created Criteria in storage.
     *
     * @param CreateCriteriaRequest $request
     *
     * @return Response
     */
    public function store(CreateCriteriaRequest $request)
    {
        try {
            $input = $request->all();
            foreach ($request->level as $key => $value) {
                $max_array[] = $value['score'];
            }
            $input['max_score'] = max($max_array);
            $input['level'] = count($max_array);

            $criteria = $this->repository->create($input);
            $criteriaLevel = $this->criteriaLevelRepository->syncLevel($request->all(), $criteria->id);

            return $this->sendResponse($criteria, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Criteria.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $criteria = $this->repository->find($id, ['*'], true);
            $criteriaLevels = $this->criteriaLevelRepository->all(['criteria_id' => $id]);
            if (empty($criteria)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['criteria' => $criteria, 'criteriaLevels' => $criteriaLevels, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Criteria.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $criteria = $this->repository->find($id, ['*'], true);
            $criteriaLevels = $this->criteriaLevelRepository->all(['criteria_id' => $id]);
            // dd($criteriaLevels);
            if (empty($criteria)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['criteria' => $criteria, 'scores' => $criteriaLevels ?? [], 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Criteria in storage.
     *
     * @param  int              $id
     * @param UpdateCriteriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCriteriaRequest $request)
    {
        try {
            $criteria = $this->repository->find($id, ['*'], true);
            $input = $request->all();
            foreach ($request->level as $key => $value) {
                $max_array[] = $value['score'];
            }
            $input['max_score'] = max($max_array);
            $input['level'] = count($max_array);
            if (empty($criteria)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $criteria = $this->repository->update($input, $id, true);
                $this->criteriaLevelRepository->syncLevel($request->all(), $criteria->id);
                return $this->sendResponse($criteria, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
