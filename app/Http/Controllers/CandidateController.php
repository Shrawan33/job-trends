<?php

namespace App\Http\Controllers;

use App\Repositories\EmployerJobSkillRepository;
use App\Repositories\UserRepository;
use Laracasts\Flash\Flash;
use App\Repositories\FavoriteCandidateRepository;
use Illuminate\Http\Request;
use Throwable;
use App\Classes\NotifyCandidate;
use App\Events\CreditUtilizationEvent;
use App\Repositories\BadgeRepository;
use App\Repositories\UserReviewRepository;
use App\Repositories\SkillRepository;
use App\Repositories\UserPackageRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CandidateController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $favoriteCandidateRepos;
    public $userProfileRepo;
    public $UserRepository;
    public $employerJobSkillRepository;
    public $badgeRepository;
    public $userReviewRepository;
    private $skillRepository;
    public $userPackageRepository;

    public function __construct(FavoriteCandidateRepository $FavoriteCandidate, UserRepository $UserRepo, EmployerJobSkillRepository $EmployerJobSkillRepo, BadgeRepository $BadgeRepo, UserReviewRepository $UserReviewRepo,SkillRepository $skillRepository, UserPackageRepository $userPackageRepo)
    {
        $this->favoriteCandidateRepos = $FavoriteCandidate;
        $this->repository = $UserRepo;
        $this->skillRepository = $skillRepository;
        $this->employerJobSkillRepository = $EmployerJobSkillRepo;
        $this->badgeRepository = $BadgeRepo;
        $this->userReviewRepository = $UserReviewRepo;
        $this->userPackageRepository = $userPackageRepo;
        $this->getEntity('candidates');
    }

    public function index(Request $request)
    {
        // dd($request->all());

        $input = $request->input();
        // $candidates = $this->repository->search($request->all());

        return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'input' => $input]);
    }

    public function show($slug)
    {
        try {
            $candidate = $this->repository->find($slug, ['*'], true, true);
            $candidate_id = $candidate->id;

            $badges = $this->badgeRepository->getBadges($candidate_id);
            //dd($badges);
            $reviews = $this->userReviewRepository->reviews($candidate_id);
            //dd($reviews->toArray());
            if (empty($candidate)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }



            $layout = 'front';


            $url = url()->current();
            $socialShare = \Share::page(
                $url
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp()
            ->telegram();

            $unlocked = $this->userPackageRepository->candidateUnlocked($candidate_id);
            if (!$unlocked) {
                try {
                    $userPackage = auth()->user()->activeUserPackage;
                    throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
                    CreditUtilizationEvent::dispatch($candidate, $userPackage, 'profile');
                } catch (Throwable $e) {
                    return redirect(route('social-profile.show', ['slug' => $slug]))->withInput(['toast_error' => $e->getMessage()]);
                }
            }

            return view($this->entity['view'] . '.show', ['candidate' => $candidate, 'entity' => $this->entity, 'layout' => $layout, 'badges' => $badges, 'reviews' => $reviews, 'socialShare' => $socialShare,'url' => $url]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function showSocial($slug)
    {
        try {
            $candidate = $this->repository->find($slug, ['*'], true, true);
            $candidate_id = $candidate->id;

            $badges = $this->badgeRepository->getBadges($candidate_id);

            $reviews = $this->userReviewRepository->reviews($candidate_id);

            if (empty($candidate)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $layout = 'front';

            $url = url()->current();
            $socialShare = \Share::page(
                $url
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp()
            ->telegram();

            $userPackage = auth()->user()->activeUserPackage;
            $creditAvailable = $this->userPackageRepository->getTypeWiseCredit($userPackage, 'profile');

            return view($this->entity['view'] . '.show', ['candidate' => $candidate, 'entity' => $this->entity, 'layout' => $layout, 'badges' => $badges, 'reviews' => $reviews, 'socialShare' => $socialShare, 'url' => $url, 'creditAvailable' => $creditAvailable]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    // public function sendMessageForm($id)
    // {
    //     try {
    //         $candidate = $this->repository->find($id, ['*'], true);

    //         if (empty($candidate)) {
    //             return $this->sendError($this->entity['singular'] . ' not found');
    //         }
    //         $modal = view($this->entity['view'] . '.send_message', ['entity' => $this->entity, 'candidate' => $candidate])->render();

    //         return $this->sendResponse($modal, '');
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }

    // public function sendMessage(Request $request)
    // {
    //     $data = ['subject' => $request->subject ?? '', 'message' => $request->message ?? ''];
    //     $message = trans('message.notification_successfull');
    //     try {
    //         if (!empty($request->get('via', []))) {
    //             //notification
    //             (new NotifyCandidate($request->id, $data, 'SendMessage', $request->get('via', [])))->notify();
    //         }
    //     } catch (Throwable $e) {
    //         throw $e;
    //         $message = $e->getMessage();
    //     }
    //     return $this->sendResponse($data, $message);
    // }

    public function makeFavourite(Request $request, $id)
    {
        try {
            // dd($request->get('from'));
            $input = ['user_id' => $id];
            $favourite = $this->favoriteCandidateRepos->create($input);
            $params = ['model' => $favourite->user];
            $from = $request->get('from', null);
            $params = $this->setCssParams($from, $params);
            $favourite->refreshContentId = 'favourite_action_' . $favourite->user->id;
            $favourite->refreshContent = view('components.candidate_buttons.favourit', $params)->render();
            return $this->sendResponse($favourite, trans('message.candidate_marked_favourite'));
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    private function setCssParams($from = 'detail-page', $params = [])
    {
        $btn_class = ' btn-md';
        $sendmail_btn_class = ' btn-sm';
        if ($from == 'detail-page') {
            $params['from'] = $from;
            $btn_class = 'btn-lg';
            $sendmail_btn_class = '';
        }
        $params = array_merge($params, ['class_unfav_btn' => $btn_class, 'class_fav_btn' => $btn_class, 'class_sendmail_btn' => $sendmail_btn_class,
            'class_sendmailmobile_btn' => $btn_class]);
        return $params;
    }

    public function removeFavourite(Request $request, $id)
    {
        try {
            // dd($request->all());

            $favourite = $this->favoriteCandidateRepos->model()::where('user_id', $id)->first();
            $favourite->forceDelete();
            $params = ['model' => $favourite->user];
            $from = $request->get('from', null);
            $params = $this->setCssParams($from, $params);
            $favourite->refreshContentId = 'favourite_action_' . $favourite->user->id;
            $favourite->refreshContent = view('components.candidate_buttons.favourit', $params)->render();
            return $this->sendResponse($favourite, trans('message.candidate_unmarked_favourite'));
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $candidates = [];
        $input = [];

        if (!empty($request->all())) {
            $candidates = $this->repository->search($request->all());
            $input = $request->input();
        }
        if ($request->ajax()) {
            $modal = view($this->entity['view'] . '.list-candidates', ['entity' => $this->entity, 'candidates' => $candidates, 'input' => $input])->render();

            return $this->sendResponse($modal, '');
        }
    }

    public function review(Request $request)
    {
        if (!empty($request->all())) {

            $input = $request->all();
            $reviews = $this->userReviewRepository->reviews($input['candidate_id'], $input['badge_id']);
        }

        if ($request->ajax()) {
            $modal = view('candidates.inner_review', ['reviews' => $reviews])->render();

            return $this->sendResponse($modal, '');
        }
    }

    public function ajaxSkills(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['title' => $request->get('term', '')];
        $data = $this->skillRepository->all($search, null, $limit, ['id', 'title', 'title as text']);
        // dd($data);
        return response()->json(['results' => $data]);
    }

    // public function shareSocial()
    // {
    //     $socialShare = \Share::page(
    //         'https://www.abc.com/laravel-custom-foreign-key-name-example',
    //         'Laravel Custom Foreign Key Name Example',
    //     )
    //     ->facebook()
    //     ->twitter()
    //     ->reddit()
    //     ->linkedin()
    //     ->whatsapp()
    //     ->telegram();

    //     return view('candidates.share-social', compact('socialShare'));
    // }

}
