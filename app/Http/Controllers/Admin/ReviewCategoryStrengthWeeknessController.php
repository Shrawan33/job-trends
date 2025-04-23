<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewCategoryStrengthWeeknessDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReviewCategoryStrengthWeeknessRequest;
use App\Http\Requests\UpdateReviewCategoryStrengthWeeknessRequest;
use App\Repositories\ReviewCategoryStrengthWeeknessRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class ReviewCategoryStrengthWeeknessController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(ReviewCategoryStrengthWeeknessRepository $reviewCategoryStrengthWeeknessRepo)
    {
        $this->repository = $reviewCategoryStrengthWeeknessRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the ReviewCategoryStrengthWeekness.
     *
     * @param ReviewCategoryStrengthWeeknessDataTable $reviewCategoryStrengthWeeknessDataTable
     * @return Response
     */
    public function index(ReviewCategoryStrengthWeeknessDataTable $reviewCategoryStrengthWeeknessDataTable)
    {
        return $reviewCategoryStrengthWeeknessDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new ReviewCategoryStrengthWeekness.
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
     * Store a newly created ReviewCategoryStrengthWeekness in storage.
     *
     * @param CreateReviewCategoryStrengthWeeknessRequest $request
     *
     * @return Response
     */
    public function store(CreateReviewCategoryStrengthWeeknessRequest $request)
    {
        try {
            $input = $request->all();
            $reviewCategoryStrengthWeekness = $this->repository->create($input);

            return $this->sendResponse($reviewCategoryStrengthWeekness, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified ReviewCategoryStrengthWeekness.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $reviewCategoryStrengthWeekness = $this->repository->find($id, ['*'], true);

            if (empty($reviewCategoryStrengthWeekness)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['reviewCategoryStrengthWeekness' => $reviewCategoryStrengthWeekness, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified ReviewCategoryStrengthWeekness.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $reviewCategoryStrengthWeekness = $this->repository->find($id, ['*'], true);

            if (empty($reviewCategoryStrengthWeekness)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['reviewCategoryStrengthWeekness' => $reviewCategoryStrengthWeekness, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified ReviewCategoryStrengthWeekness in storage.
     *
     * @param  int              $id
     * @param UpdateReviewCategoryStrengthWeeknessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReviewCategoryStrengthWeeknessRequest $request)
    {
        try {
            $reviewCategoryStrengthWeekness = $this->repository->find($id, ['*'], true);

            if (empty($reviewCategoryStrengthWeekness)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $reviewCategoryStrengthWeekness = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($reviewCategoryStrengthWeekness, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
