<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SalaryDataTable;
use App\Http\Requests\CreateSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Repositories\SalaryRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class SalaryController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(SalaryRepository $salaryRepo)
    {
        $this->repository = $salaryRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Salary.
     *
     * @param SalaryDataTable $salaryDataTable
     * @return Response
     */
    public function index(SalaryDataTable $salaryDataTable)
    {
        return $salaryDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Salary.
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
     * Store a newly created Salary in storage.
     *
     * @param CreateSalaryRequest $request
     *
     * @return Response
     */
    public function store(CreateSalaryRequest $request)
    {
        try {
            $input = $request->all();

            $salary = $this->repository->create($input);

            return $this->sendResponse($salary, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Salary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $salary = $this->repository->find($id, ['*'], true);

            if (empty($salary)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['salary' => $salary, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Salary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $salary = $this->repository->find($id, ['*'], true);

            if (empty($salary)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['salary' => $salary, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Salary in storage.
     *
     * @param  int              $id
     * @param UpdateSalaryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSalaryRequest $request)
    {
        try {
            $salary = $this->repository->find($id, ['*'], true);

            if (empty($salary)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $salary = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($salary, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
