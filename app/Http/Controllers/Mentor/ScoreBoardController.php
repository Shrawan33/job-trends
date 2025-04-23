<?php

namespace App\Http\Controllers\Mentor;

use App\Helpers\FunctionHelper;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateScoreRequest;
use App\Repositories\CriteriaLevelRepository;
use App\Repositories\CriteriaRepository;
use App\Repositories\ScoreBoardRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Response;
use Throwable;

class ScoreBoardController extends AppBaseController
{
    /** @var $repository repository */
    public $repository;
    private $criteriaRepository;
    private $criteriaLevelRepository;
    private $userRepository;

    public function __construct(ScoreBoardRepository $scoreBoardRepo, CriteriaRepository $criteriaRepo, CriteriaLevelRepository $criteriaLevelRepo, UserRepository $UserRepo)
    {
        $this->repository = $scoreBoardRepo;
        $this->criteriaRepository = $criteriaRepo;
        $this->criteriaLevelRepository = $criteriaLevelRepo;
        $this->userRepository = $UserRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->input();

        return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'input' => $input]);
    }

    /**
     * Show the form for Score a User.
     *
     * @return Response
     */
    public function scorePopup($user_id)
    {
        try {
            $modal = view($this->entity['view'] . '.score', ['entity' => $this->entity, 'user_id' => $user_id])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created score in storage.
     *
     * @param CreateScoreRequest $request
     *
     * @return Response
     */
    public function scoreSave(CreateScoreRequest $request)
    {
        // dd($request->all());
        try {
            $scores = $this->repository->synScore($request->all(), $request->user_id);

            return $this->sendResponse(['callbackFunction' => 'void(0);'], 'Score updated successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function ajaxAverageScore(Request $request)
    {
        try {
            //Get on change average score
            $total = 0;
            // if ($request->get('id', null)) {
            //     $score = $this->repository->find($request->id);
            //     $score->score = $request->score_id;
            //     $score->save();
            // }
            $criterias = $this->criteriaLevelRepository->all();
            // dd($criterias);
            // $scores = $this->repository->all(['user_id' => $request->user_id]);

            if (!empty($request->score)) {
                foreach ($request->score as $key => $score) {
                    $criteriaLevelScore = $criterias->where('criteria_id', $key)->where('level', $score['level'])->first();
                    $total += $criteriaLevelScore->score ?? 0;
                }
            }

            $criteriaQuery = $this->criteriaRepository->allQuery();

            $totalAvg = FunctionHelper::averageScore($total, $criteriaQuery->sum('max_score'), config('constants.criteria_max_level', 5));

            $modal = view('mentor_candidates.average_score', ['totalAvg' => $totalAvg])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }
        return redirect()->back()->withInput($request->all());
    }

    public function show($id)
    {
        try {
            $candidate = $this->userRepository->find($id, ['*'], true);

            if (empty($candidate)) {
                Flash::error('Candidate not found');

                return redirect(route('mentor.candidates.index'));
            }
            $layout = 'admin';
            return view('candidates.show', ['candidate' => $candidate, 'entity' => $this->entity, 'layout' => $layout]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
}
