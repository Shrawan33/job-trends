<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewCategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReviewCategoryRequest;
use App\Http\Requests\UpdateReviewCategoryRequest;
use App\Repositories\ReviewCategoryRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class ReviewCategoryController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(ReviewCategoryRepository $reviewCategoryRepo)
    {
        $this->repository = $reviewCategoryRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the ReviewCategory.
     *
     * @param ReviewCategoryDataTable $reviewCategoryDataTable
     * @return Response
     */
    public function index(ReviewCategoryDataTable $reviewCategoryDataTable)
    {
        return $reviewCategoryDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new ReviewCategory.
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
     * Store a newly created ReviewCategory in storage.
     *
     * @param CreateReviewCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateReviewCategoryRequest $request)
    {
        try {
            $input = $request->all();

            $reviewCategory = $this->repository->create($input);

            return $this->sendResponse($reviewCategory, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified ReviewCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $reviewCategory = $this->repository->find($id, ['*'], true);

            if (empty($reviewCategory)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['reviewCategory' => $reviewCategory, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified ReviewCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $reviewCategory = $this->repository->find($id, ['*'], true);

            if (empty($reviewCategory)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['reviewCategory' => $reviewCategory, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified ReviewCategory in storage.
     *
     * @param  int              $id
     * @param UpdateReviewCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReviewCategoryRequest $request)
    {
        try {
            $reviewCategory = $this->repository->find($id, ['*'], true);

            if (empty($reviewCategory)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $reviewCategory = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($reviewCategory, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
