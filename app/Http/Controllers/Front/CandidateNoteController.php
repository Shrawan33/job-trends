<?php

namespace App\Http\Controllers\Front;

use App\DataTables\CandidateNoteDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCandidateNoteRequest;
use App\Http\Requests\UpdateCandidateNoteRequest;
use App\Repositories\CandidateNoteRepository;
use App\Repositories\UserRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;

class CandidateNoteController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(CandidateNoteRepository $candidateNoteRepo, UserRepository $userRepo)
    {
        $this->repository = $candidateNoteRepo;
        $this->userRepository = $userRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the CandidateNote.
     *
     * @param CandidateNoteDataTable $candidateNoteDataTable
     * @return Response
     */
    public function index(CandidateNoteDataTable $candidateNoteDataTable)
    {
        return $candidateNoteDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new CandidateNote.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        try {
            $record = $this->userRepository->find($request->get('id'), ['*'], true);

            if (empty($record)) {
                return $this->sendError('record not found');
            }
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'record' => $record, 'view' => $request->get('entity')])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created CandidateNote in storage.
     *
     * @param CreateCandidateNoteRequest $request
     *
     * @return Response
     */
    public function store(CreateCandidateNoteRequest $request)
    {
        try {
            $input = $request->all();
            $input['employer_id'] = Auth::user()->id;
            $candidateNote = $this->repository->create($input);
            $candidateNote->refreshContentId = 'note-list';
            $candidateNote->refreshContent = view('components.note_list', ['candidate' => $candidateNote->candidate])->render();
            return $this->sendResponse($candidateNote,'Remark Saved Successfully');
        } catch (Throwable $e) {
            throw $e;
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified CandidateNote.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $candidateNote = $this->repository->find($id, ['*'], true);

            if (empty($candidateNote)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['candidateNote' => $candidateNote, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified CandidateNote.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $candidateNote = $this->repository->find($id, ['*'], true);

            if (empty($candidateNote)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['candidateNote' => $candidateNote, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified CandidateNote in storage.
     *
     * @param  int              $id
     * @param UpdateCandidateNoteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCandidateNoteRequest $request)
    {
        try {
            $candidateNote = $this->repository->find($id, ['*'], true);

            if (empty($candidateNote)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $candidateNote = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' Updated Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
