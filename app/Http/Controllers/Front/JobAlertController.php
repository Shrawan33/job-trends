<?php

namespace App\Http\Controllers\Front;

use App\DataTables\JobAlertDataTable;
use App\Http\Requests\CreateJobAlertRequest;
use App\Http\Requests\UpdateJobAlertRequest;
use App\Repositories\JobAlertRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\User;

use App\Notifications\JobAlertNotification;
use Response;
use Throwable;

class JobAlertController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(JobAlertRepository $jobAlertRepo)
    {
        $this->repository = $jobAlertRepo;
        $this->getEntity('jobAlerts');
    }

    /**
     * Display a listing of the JobAlert.
     *
     * @param JobAlertDataTable $jobAlertDataTable
     * @return Response
     */
    public function index(JobAlertDataTable $jobAlertDataTable)
    {
        return $jobAlertDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new JobAlert.
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
     * Store a newly created JobAlert in storage.
     *
     * @param CreateJobAlertRequest $request
     *
     * @return Response
     */
    public function store(CreateJobAlertRequest $request)
    {
        try {
            $input = $request->all();
// dd($input);
            $jobAlert = $this->repository->create($input);
            // $jobAlert->notify(new JobAlertNotification($jobAlert));
            $message = $this->entity['singular'] . ' Saved Successfully';

            return $this->sendResponse($jobAlert, $message);
        } catch (Throwable $e) {
            $message = $e->getMessage();
            return $this->sendError($message);
        }
    }

    /**
     * Display the specified JobAlert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $jobAlert = $this->repository->find($id, ['*'], true);

            if (empty($jobAlert)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['jobAlert' => $jobAlert, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified JobAlert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $jobAlert = $this->repository->find($id, ['*'], true);

            if (empty($jobAlert)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['jobAlert' => $jobAlert, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified JobAlert in storage.
     *
     * @param  int              $id
     * @param UpdateJobAlertRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobAlertRequest $request)
    {
        try {
            $jobAlert = $this->repository->find($id, ['*'], true);

            if (empty($jobAlert)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $jobAlert = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' Updated Successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
