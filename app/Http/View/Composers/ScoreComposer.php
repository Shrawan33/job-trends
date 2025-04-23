<?php

namespace App\Http\View\Composers;

use App\Helpers\FunctionHelper;
use App\Repositories\CriteriaLevelRepository;
use App\Repositories\CriteriaRepository;
use App\Repositories\ScoreBoardRepository;
use Illuminate\View\View;

class ScoreComposer
{
    private $scoreBoardRepository;
    private $criteriaRepository;
    private $criteriaLevelRepository;

    public function __construct(ScoreBoardRepository $scoreBoardRepo, CriteriaRepository $criteriaRepo, CriteriaLevelRepository $criteriaLevelRepo)
    {
        $this->scoreBoardRepository = $scoreBoardRepo;
        $this->criteriaRepository = $criteriaRepo;
        $this->criteriaLevelRepository = $criteriaLevelRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $totalAvg = $total = 0;
        $scoreIds = $levelIds = null;
        $levels = [];
        $criteriaQuery = $this->criteriaRepository->allQuery();
        $criterias = $criteriaQuery->get()->pluck('title', 'id');

        $levels = $this->criteriaRepository->criteriaLevelRange();
        $scores = $this->scoreBoardRepository->all(['user_id' => $view->user_id]);
        if (!empty($scores)) {
            $levelIds = $scores->pluck('score', 'criteria');
            $scoreIds = $scores->pluck('id', 'criteria');
            foreach ($scores as  $score) {
                $query = $this->criteriaLevelRepository->allQuery();
                $query->where('criteria_id', $score->criteria);
                $query->where('level', $score->score);
                $criteriaLevel = $query->first();

                $total += $criteriaLevel->score ?? 0;
            }
            $totalAvg = FunctionHelper::averageScore($total, $criteriaQuery->sum('max_score'), config('constants.criteria_max_level', 5));
        }
        // dd($levels);
        $view->with([
            'scoreIds' => $scoreIds,
            'totalAvg' => $totalAvg,
            'levelIds' => $levelIds,
            'criterias' => $criterias,
            'levels' => $levels
        ]);
    }
}
