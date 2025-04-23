<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LanguageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Repositories\LanguageRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class LanguageController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->repository = $languageRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Language.
     *
     * @param LanguageDataTable $languageDataTable
     * @return Response
     */
    public function index(LanguageDataTable $languageDataTable)
    {
        return $languageDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Language.
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
     * Store a newly created Language in storage.
     *
     * @param CreateLanguageRequest $request
     *
     * @return Response
     */
    public function store(CreateLanguageRequest $request)
    {
        try {
            $input = $request->all();
            $language = $this->repository->create($input);
            return $this->sendResponse($language, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $language = $this->repository->find($id, ['*'], true);

            if (empty($language)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['language' => $language, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $language = $this->repository->find($id, ['*'], true);

            if (empty($language)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['language' => $language, 'entity' => $this->entity])->render();
                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Language in storage.
     *
     * @param  int              $id
     * @param UpdateLanguageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLanguageRequest $request)
    {
        try {
            $language = $this->repository->find($id, ['*'], true);

            if (empty($language)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $language = $this->repository->update($request->all(), $id, true);
                return $this->sendResponse($language, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
