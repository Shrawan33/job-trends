<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CertificationDatatable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateICertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;
use App\Imports\CertificationShitImport;
use App\Imports\SkillSheetmport;
use App\Repositories\CertificationRepository;
use Response;
use Throwable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class CertificationController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(CertificationRepository $certificationRepository)
    {
        $this->repository = $certificationRepository;
        $this->getEntity();
    }

    /**
     * Display a listing of the Certification.
     *
     * @param CertificationDatatable $certificationDatatable
     * @return Response
     */
    public function index(CertificationDatatable $certificationDatatable)
    {
        return $certificationDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Certification.
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
     * Store a newly created Certification in storage.
     *
     * @param CreateICertificationRequest $request
     *
     * @return Response
     */
    public function store(CreateICertificationRequest $request)
    {
        try {
            $input = $request->all();

            $Certification = $this->repository->create($input);

            return $this->sendResponse($Certification, $this->entity['singular'] . ' Saved Successfully');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Certification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $certification = $this->repository->find($id, ['*'], true);

            if (empty($certification)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['certification' => $certification, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Certification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $certification = $this->repository->find($id, ['*'], true);

            if (empty($certification)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['certification' => $certification, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Certification in storage.
     *
     * @param  int              $id
     * @param UpdateCertificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCertificationRequest $request)
    {
        try {
            $certification = $this->repository->find($id, ['*'], true);

            if (empty($certification)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $certification = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($certification, $this->entity['singular'] . ' Updated Successfully');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

     public function getImportfile()
    {
        $modal = view($this->entity['view'] . '.import')->render();

        return $this->sendResponse($modal, '');
    }

    public function import(Request $request)
    {
        if ($request->file('import_file') ?? false) {
            Excel::import(new CertificationShitImport, $request->file('import_file'));
            return $this->sendResponse([], 'Import successfully.');
        } else {
            return $this->sendError($this->entity['singular'] . ' import file not found');
        }
    }
}
