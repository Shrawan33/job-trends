<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReportDatatable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EmployerJobRepository;
use App\Repositories\ReportRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Throwable;

class ReportAbuseController extends AppBaseController
{
    public $repository;
    private $employerJob;
    private $user;

    public function __construct(ReportRepository $reportRepository, EmployerJobRepository $employerJobRepo, UserRepository $userRepo)
    {
        $this->repository = $reportRepository;
        $this->employerJob = $employerJobRepo;
        $this->user = $userRepo;
        $this->getEntity('reports-abuses');
    }

    /**
     * Display a listing of the ReportDatatable.
     *
     * @param ReportDatatable $ReportDatatable
     * @return Response
     */
    // public function index(ReportDatatable $reportDatatable)
    // {
    //     return $reportDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    // }

    public function typeIndex(ReportDatatable $reportDatatable, $report_type)
    {
        return $reportDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity, 'report_type' => $report_type]);
    }

    /**
     * Display the specified Report.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function create()
    {
    }

    public function store()
    {
    }

    public function show($id)
    {
        try {
            $report = $this->repository->find($id, ['*'], true);

            if (empty($report)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['report' => $report, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function activeInactive($model, $id, Request $request)
    {
        $record = $this->$model->find($id, ['*'], true);
        $message = '';

        if (empty($record)) {
            return $this->sendError($model . ' not found');
        }

        try {
            switch ($request->method()) {
                case 'PATCH':
                    if ($request->get('process', null) == 'restore') {
                        $message = 'Activate';
                        $record = $this->$model->restore($id);
                    } else {
                        $input = $request->only('status');
                        $message = 'status updated';
                        $record = $this->$model->update($input, $id);
                    }
                    break;
                case 'DELETE':
                    if ($request->get('process', null) == 'archive') {
                        $message = 'Deactivate';
                    } else {
                        $message = 'Deleted';
                        $record->is_deleted = 1;
                        $record->save();
                    }
                    $this->$model->delete($id);
                    break;
                default:
                    return $this->sendError('Invalid method used, only Patch or Delete allowed.', 400);
                    break;
            }

            // dd($table);
            return $this->sendResponse(['callbackFunction' => "reloadDataTable('reports-abus');"], 'Report ' . $message . ' successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
