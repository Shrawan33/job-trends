<?php

namespace App\Http\Controllers\Account;

use App\DataTables\AssignEmployerDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;
use Throwable;
/**
 * display employer on account assign board.
 */
class AssignBoardController extends AppBaseController
{
    public $repository;

    public function __construct(UserRepository $UserRepo)
    {
        $this->repository = $UserRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, AssignEmployerDataTable $assignEmployerDataTable)
    {
        $input = $request->input();

        $seeEmployers = $assignEmployerDataTable->render($this->entity['view'] . '.employer.index', ['entity' => $this->entity]);

        return view($this->entity['view'] . '.index', ['entity' => $this->entity,  'seeEmployers' => $seeEmployers, 'input' => $input]);
    }

    public function ajaxEmployers(AssignEmployerDataTable $assignEmployerDataTable)
    {
        return $assignEmployerDataTable->render($this->entity['view'] . '.employer.index', ['entity' => $this->entity]);
    }

    public function show($id)
    {
        try {
            $candidate = $this->repository->find($id, ['*'], true);

            if (empty($candidate)) {
                Flash::error('Candidate not found');

                return redirect(route('account.candidates.index'));
            }
            $layout = 'admin';
            return view('candidates.show', ['candidate' => $candidate, 'entity' => $this->entity, 'layout' => $layout]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function employerShow($id)
    {
        try {
            $user = $this->repository->find($id, ['*'], true);
            $user->role_title = 'Employer';

            if (empty($user)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view('users.show_fields', ['user' => $user, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
