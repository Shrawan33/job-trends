<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\EmployerRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Throwable;

class EmployerController extends AppBaseController
{
    public $repository;
    public $userProfileRepository;
    public $userRepository;

    public function __construct(UserRepository $UserRepo, EmployerRepository $EmployerRepo, UserProfileRepository $UserProfileRepo)
    {

        $this->userRepository = $UserRepo;
        $this->repository = $EmployerRepo;
        $this->userProfileRepository = $UserProfileRepo;

        $this->getEntity('employers');
    }

    public function index(Request $request)
    {
        $criteria = $request->all();
        $input = $request->input();
        $employers = $this->repository->search($criteria);
        // dd($employers);
        return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'employers' => $employers, 'input' => $input]);
    }

    public function show($id)
    {
        try {
            $employer = $this->repository->find($id, ['*'], true, false);
            $ids = is_array($id) ? $id : [$id];

            if (empty($employer)) {
                Flash::error($this->entity['singular'] . ' not found');
                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['candidate' => $employer, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $employers = [];
        $input = [];

        if (!empty($request->all())) {
            $employers = $this->repository->search($request->all());
            $input = $request->input();
        }
        if ($request->ajax()) {
            $modal = view($this->entity['view'] . '.list-employers', ['entity' => $this->entity, 'employers' => $employers, 'input' => $input])->render();

            return $this->sendResponse($modal, '');
        }
    }

}
