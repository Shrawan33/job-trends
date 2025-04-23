<?php

namespace App\Http\View\Composers;

use App\Helpers\FunctionHelper;
use App\Repositories\ApplyJobRepository;
use App\Repositories\BadgeRepository;
use App\Repositories\CriteriaLevelRepository;
use App\Repositories\CriteriaRepository;
use Illuminate\View\View;
use App\Repositories\ExperienceRepository;
use App\Repositories\LocationRepository;
use App\Repositories\SpecializationRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\SalaryRepository;
use App\Repositories\ScoreBoardRepository;
use App\Repositories\SkillRepository;
use App\Repositories\StateRepository;
use App\Repositories\UserPackageRepository;
use App\Repositories\UserRepository;
use App\Repositories\WorkTypeRepository;

class CandidatesComposer
{
    private $locationRepository;
    private $skillRepository;
    private $experienceRepository;
    private $qualificationRepository;
    private $jobtypesRepository;
    private $stateRepository;
    private $userRepository;
    private $salaryRepository;
    private $userPackageRepository;
    private $applyJobRepository;
    private $scoreBoardRepository;
    private $criteriaRepository;
    private $criteriaLevelRepository;
    private $specializationRepository;
    private $badgeRepository;

    public function __construct(UserRepository $userRepo, SkillRepository $skillRepo, ExperienceRepository $experienceRepo, QualificationRepository $qualificationRepo, LocationRepository $locationRepo, WorkTypeRepository $workTypeRepo, StateRepository $stateRepo, UserPackageRepository $userPackageRepo, SalaryRepository $salaryRepo, ApplyJobRepository $applyJobRepo, ScoreBoardRepository $scoreBoardRepo, CriteriaRepository $criteriaRepo, CriteriaLevelRepository $criteriaLevelRepo, SpecializationRepository $specializationRepository, BadgeRepository $badgeRepo)
    {
        $this->skillRepository = $skillRepo;
        $this->experienceRepository = $experienceRepo;
        $this->qualificationRepository = $qualificationRepo;
        $this->locationRepository = $locationRepo;
        $this->jobtypesRepository = $workTypeRepo;
        $this->salaryRepository = $salaryRepo;
        $this->userRepository = $userRepo;
        $this->stateRepository = $stateRepo;
        $this->userPackageRepository = $userPackageRepo;
        $this->applyJobRepository = $applyJobRepo;
        $this->scoreBoardRepository = $scoreBoardRepo;
        $this->criteriaRepository = $criteriaRepo;
        $this->criteriaLevelRepository = $criteriaLevelRepo;
        $this->specializationRepository = $specializationRepository;
        $this->badgeRepository = $badgeRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
            $locationFilter = ['' => ''] + $this->locationRepository->all()->pluck('title', 'id')->toArray();
            $stateFilter = ['' => ''] + $this->stateRepository->all()->pluck('title', 'id')->toArray();
            $skillFilter = $this->skillRepository->all()->pluck('title', 'id')->toArray();
            $experinceFilter = $this->experienceRepository->all()->pluck('title', 'id')->toArray();
            $qualificationFilter = $this->qualificationRepository->all()->pluck('title', 'id')->toArray();
            $specializationFilter = $this->specializationRepository->all()->pluck('name', 'id')->toArray();
            $salaryFilter = $this->salaryRepository->all()->pluck('title', 'id')->toArray();
            $salaryTypeFilter = config('constants.salary_type.data');
            $jobtypeFilter = $this->jobtypesRepository->all()->pluck('title', 'id')->toArray();
            $candidates = [];
            $scores = [];
            $unlocked = false;
            $unlock_url = '#';
            $totalAvg = $total = 0;

            if ($view->entity['prefix'] == 'account') {
                $targetUrl = 'account-dashboard.index';
                $prefix = 'account.' ;
            } elseif ($view->entity['prefix'] == 'mentor') {
                $targetUrl = 'mentor_candidates.index';
                $prefix = 'mentor.';
            } else {
                $targetUrl = $view->entity['url'] . '.index' ;
                $prefix = '';
            }

        switch ($view->getName()) {
            case 'candidates.partial_index':
            case 'candidates.index':
                $candidates = $this->userRepository->search($view->input);
                // dd($view);
                // if ($view->candidates) {
                //     $candidates = $view->candidates;
                // } else {
                //     $query = $this->userRepository->allQuery();
                //     $query->WithRole();
                //     $query->selectRaw('users.*, model_has_roles.role_id');
                //     $query->where('model_has_roles.role_id', '=', 3);
                //     $query->groupBy('users.id');
                //     $candidates = $query->paginate(config('constants.pagination.page_no'))->fragment('search');
                // }

                break;
            case 'auth.job_seeker.show':
            case 'candidates.show':
                // dd($view->candidate->appliedJobs->count());
                if (auth()->user()->id == $view->candidate->id) {
                    $unlocked = true;
                    $unlock_url = '#';
                } else {
                    $unlocked = false;
                    $unlock_url = '#';
                }
                if (!empty(auth()->user()->activeUserPackage)) {
                    if ($view->candidate->appliedJobs->count() > 0) {
                        $unlocked = true;
                        $unlock_url = '#';
                    } else {
                        $unlocked = $this->userPackageRepository->candidateUnlocked($view->candidate->id);
                        $unlock_url = route('unlock-candidate', $view->candidate->id);
                    }
                }
                if ($prefix == 'mentor.') {
                    $unlocked = true;
                    $unlock_url = '#';
                }

                $scores = $this->scoreBoardRepository->all(['user_id' => $view->candidate->id]);
                if (!empty($scores)) {
                    foreach ($scores as  $score) {
                        $query = $this->criteriaLevelRepository->allQuery();
                        $query->where('criteria_id', $score->criteria);
                        $query->where('level', $score->score);
                        $criteriaLevel = $query->first();

                        $total += $criteriaLevel->score ?? 0;
                    }
                    $criteriaQuery = $this->criteriaRepository->allQuery();
                    $totalAvg = FunctionHelper::averageScore($total, $criteriaQuery->sum('max_score'), config('constants.criteria_max_level', 5));
                    // dd($totalAvg);
                }
                break;
        }
        // dd($candidates);
        return $view->with([
            'locationFilter' => $locationFilter,
            'stateFilter' => $stateFilter,
            'skillFilter' => $skillFilter,
            'experinceFilter' => $experinceFilter,
            'qualificationFilter' => $qualificationFilter,
            'specializationFilter' => $specializationFilter, // Pass the specialization filter to the view
            'jobtypeFilter' => $jobtypeFilter,
            'salaryFilter' => $salaryFilter,
            'salaryTypeFilter' => $salaryTypeFilter,
            'candidates' => $candidates,
            'unlocked' => $unlocked,
            'unlock_url' => $unlock_url,
            'totalAvg' => $totalAvg,
            'scores' => $scores,
            'targetUrl' => $targetUrl,
            'prefix' => $prefix
        ]);
    }
}
