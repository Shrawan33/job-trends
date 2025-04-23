<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EmployerJobRepository;
use App\Repositories\ReportRepository;
use Throwable;
use App\Classes\NotifyAdmin;
use App\Repositories\UserRepository;

class ReportController extends AppBaseController
{
    public $employerJobRepository;
    public $userRepository;
    public $repository;

    public function __construct(EmployerJobRepository $employerJobRepo, ReportRepository $reportRepository, UserRepository $userRepo)
    {
        $this->employerJobRepository = $employerJobRepo;
        $this->userRepository = $userRepo;
        $this->repository = $reportRepository;
        $this->getEntity();
    }

    public function create($entity, $id)
    {
        try {
            if ($entity == 'employerJob') {
                $record = $this->employerJobRepository->find($id, ['*'], true);
            } else {
                $record = $this->userRepository->find($id, ['*'], true);
            }

            if (empty($record)) {
                return $this->sendError('record not found');
            }
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'record' => $record, 'view' => $entity])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function store(Request $request, $entity)
    {
        try {
            $input = $request->all();
            if ($entity == 'employerJob') {
                $record = $this->employerJobRepository->find($input['reported_id'], ['*'], true);
            } else {
                $record = $this->userRepository->find($input['reported_id'], ['*'], true);
            }

            if (empty($record)) {
                return $this->sendError('record not found');
            }

            $report = $record->report()->create($input);

            //  Notification
            // (new NotifyAdmin($report, 'Report'))->notify();

            $report = $this->getRefreshcontent($entity, $report, $record);

            return $this->sendResponse($report, 'Report has been submitted.');
        } catch (Throwable $e) {
            throw $e;
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function getRefreshcontent($entity, $report, $record)
    {
        if ($entity != 'employerJob') {
            if ($entity == 'employer-view') {
                $params = ['entityData' => $report->reportedCandidate];
                $params['from'] = 'employer-view-page';
                $params['id'] = $report->reportedCandidate->id;
                $params['entity'] = 'employer-view';
            } else {
                $params = ['model' => $report->reportedCandidate];
                $params['from'] = 'detail-page';
            }

            $contentId = 'user_action_' . $record->id;
            if ($entity == 'employer-view') {
                $view = view('components.report_button', $params);
            } else {
                $view = view('components.candidate-buttons', $params);
            }
        } else {
            $contentId = 'employer_job_actions';
            $view = view('components.jobs.action_buttons', ['job' => $report->reportedJob]);
        }

        $report->refreshContentId = $contentId;
        $report->refreshContent = $view->render();
        return $report;
    }
}
