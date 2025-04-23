<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PackageCategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePackageCategoryRequest;
use App\Http\Requests\UpdatePackageCategoryRequest;
use App\Repositories\PackageCategoryRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class PackageCategoryController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(PackageCategoryRepository $packageCategoryRepo)
    {
        $this->repository = $packageCategoryRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the PackageCategory.
     *
     * @param PackageCategoryDataTable $packageCategoryDataTable
     * @return Response
     */
    public function index(PackageCategoryDataTable $packageCategoryDataTable)
    {
        return $packageCategoryDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new PackageCategory.
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
     * Store a newly created PackageCategory in storage.
     *
     * @param CreatePackageCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageCategoryRequest $request)
    {
        try {
            $input = $request->all();

            $packageCategory = $this->repository->create($input);

            return $this->sendResponse($packageCategory, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified PackageCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $packageCategory = $this->repository->find($id, ['*'], true);

            if (empty($packageCategory)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['packageCategory' => $packageCategory, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified PackageCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $packageCategory = $this->repository->find($id, ['*'], true);

            if (empty($packageCategory)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['packageCategory' => $packageCategory, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified PackageCategory in storage.
     *
     * @param  int              $id
     * @param UpdatePackageCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageCategoryRequest $request)
    {
        try {
            $packageCategory = $this->repository->find($id, ['*'], true);

            if (empty($packageCategory)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $packageCategory = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($packageCategory, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
