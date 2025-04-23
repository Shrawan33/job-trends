<?php

namespace App\Http\Controllers\Front;

use App\DataTables\FavoriteCandidateDatatable;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FavoriteCandidateRepository;
use App\Repositories\RemarkRepository;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;

class FavoriteCandidateController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $remarkRepository;

    public function __construct(FavoriteCandidateRepository $FavoriteCandidateRepo, RemarkRepository $remarkRepo)
    {
        $this->repository = $FavoriteCandidateRepo;
        $this->remarkRepository = $remarkRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the ApplyJob.
     *
     * @param favoriteCandidateDatatable $favoriteCandidateDatatable
     * @return Response
     */
    public function index(FavoriteCandidateDatatable $favoriteCandidateDatatable)
    {
        return $favoriteCandidateDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    public function store($id)
    {
        try {
            $input = [
                'employer_job_id' => $id,
                'user_id' => Auth::user()->id,
            ];

            $favourit = $this->repository->create($input);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect()->back();
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified ApplyJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view($this->entity['view'] . '.fields', ['entity' => $this->entity]);
        try {
            $favourit = $this->repository->find($id, ['*']);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['favourit' => $favourit, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified ApplyJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $employerJob = $this->repository->find($id);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['employerJob' => $employerJob, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified ApplyJob in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        try {
            $employerJob = $this->repository->find($id);

            if (empty($employerJob)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }
            // dd($request->all());
            $employerJob = $this->repository->update($request->all(), $id, true);
            //assign skill to employer jobs
            $input = $request->all();
            $skills = isset($input['skill_id']) ? $input['skill_id'] : [];
            $this->employerJobSkillRepository->syncBySkill($skills, $employerJob->id);
            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function removeFromFavourit($id)
    {
        $favourit = $this->repository->model()::where('employer_job_id', $id)->first();
        $favourit->forceDelete();
        Flash::success($this->entity['singular'] . ' Remove from favourit list successfully.');
        return redirect()->back();
    }

    public function ajaxStatus(Request $request)
    {
        try {
            $favourit = $this->repository->find($request->id);

            if (empty($favourit)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $statuses = config('constants.candidate_status');
            $favourit = $this->repository->update($request->all(), $favourit->id, true);
            // dd($favourit);
            $modal = view('components.candidate_status', ['statuses' => $statuses, 'id' => $favourit->id, 'selected' => $favourit->status])->render();
            return $this->sendResponse(['callbackFunction' => 'void(0);'], 'Status updated successfully.');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function remarkCreate($id)
    {
        try {
            $favourit = $this->repository->find($id);

            if (empty($favourit)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }
            $modal = view($this->entity['view'] . '.remark', ['favourit' => $favourit])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function remarkStore(Request $request)
    {
        $shortlisted_id = $request->shortlisted_id;
        $shortlisted = $this->repository->find($shortlisted_id);

        if (empty($shortlisted)) {
            Flash::error('Record not found');
            return redirect()->back();
        }

        try {
            //update Shorlisted Candidate

            $this->remarkRepository->syncRemark($request->all(), $shortlisted_id);

            $shortlisted->refreshContentId = 'remark_action_' . $shortlisted_id;
            $shortlisted->refreshContent = view('components.remark-button', ['model' => $shortlisted])->render();
            return $this->sendResponse($shortlisted, $shortlisted->user->full_name . ' Remark Updated successfully.');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function remarkRemove(Request $request)
    {
        $remark = $this->remarkRepository->find($request->id);
        $shortlisted = $this->repository->find($request->shortlisted_id);
        if (empty($remark)) {
            Flash::error('Remark not found');

            return redirect(route($this->entity['url'] . '.index'));
        }

        $this->remarkRepository->forcedelete($remark->id);

        return $this->sendResponse(['callbackFunction' => "$('#multi-remark-wrapper').find('tr#remark_list_$remark->id').remove();reloadDataTable('shortlisted-candidate');", 'remainOpen' => true], 'Remark removed successfully');
    }

    public function ajaxSuggestTitleSave(Request $request)
    {
        try {
            $favourit = $this->repository->find($request->id);

            if (empty($favourit)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $favourit = $this->repository->update($request->all(), $favourit->id, true);
            // dd($favourit);
            // $modal = view('components.suggest_title', ['suggest' => $favourit->suggested_title, 'id' => $favourit->id])->render();

            return $this->sendResponse(['callbackFunction' => 'void(0);'], 'Suggested Title updated successfully.');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function appliedJobsList($id)
    {
        try {
            $favouritCandidate = $this->repository->find($id);

            $appliedJobs = $favouritCandidate->appliedJobs ?? [];

            $modal = view($this->entity['view'] . '.applied_job_list', ['entity' => $this->entity, 'appliedJobs' => $appliedJobs])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
