<?php

namespace App\Http\Controllers\Front;

use App\DataTables\FavoriteJobDatatable;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FavoriteJobRepository;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;

class FavoriteJobController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(FavoriteJobRepository $favoriteJobRepo)
    {
        $this->repository = $favoriteJobRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the ApplyJob.
     *
     * @param FavoriteJobDatatable $FavoriteJobDatatable
     * @return Response
     */
    public function index(FavoriteJobDatatable $favoriteJobDatatable)
    {
        // dd($favoriteJobDatatable);
        // favorite_jobs
        return $favoriteJobDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    public function store($id)
    {
        try {
            $input = [
                'employer_job_id' => $id,
                'user_id' => Auth::user()->id,
            ];
            $favourit = $this->repository->create($input);
            $success_message ='Added to Favourite Jobs';

            return redirect()->back()->withInput(['toast_success' => $success_message]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function storeAjax($id)
    {
        try {
            $input = [
                'employer_job_id' => $id,
                'user_id' => Auth::user()->id,
            ];

            $favourit = $this->repository->create($input);


            $favourit->refreshContentId = 'employer_job_actions_'.$id;
            $favourit->refreshContent = view('components.ajax-favourit-job-buttons', [
                'class_a' => 'social_btn',
                'id' => $id,
                'entityData' => $favourit->employerJob ?? [],
            ])->render();

            $success_message ='Added to Favourite Jobs';
            return $this->sendResponse($favourit, $success_message);
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
            $employerJob = $this->repository->find($id, ['*']);

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
            $employerJob = $this->repository->find($id, ['*'], true);

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
        $success_message = 'Removed From Favourite Jobs';

        // Flash::success($this->entity['singular'] . ' Remove from favourite list successfully.');
        return redirect()->back()->withInput(['toast_success' => $success_message]);;
    }

    public function removeFromFavouritAjax($id)
    {
        $favourit = $this->repository->model()::where('employer_job_id', $id)->first();
        $favourit->forceDelete();


        $favourit->refreshContentId = 'employer_job_actions_'.$id;
        $favourit->refreshContent = view('components.ajax-favourit-job-buttons', [
            'class_a' => 'social_btn',
            'id' => $id,
            'entityData' => $favourit->employerJob ?? [],
        ])->render();

        $success_message = 'Removed From Favourite Jobs';

        /*$applyjob->refreshContentId = 'job-display-action';
        $applyjob->refreshContent = view('components.jobs.action_buttons', ['job' => $applyjob->employerJob])->render();*/

        return $this->sendResponse($favourit, $success_message);







        // Flash::success($this->entity['singular'] . ' Remove from favourite list successfully.');
        // return redirect()->back()->withInput(['toast_success' => $success_message]);;
    }

}
