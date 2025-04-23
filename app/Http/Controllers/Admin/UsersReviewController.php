<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersReviewDatatable;
use App\Http\Controllers\AppBaseController;
use App\Models\UserReview;
use App\Notifications\HootNotification;
use App\Repositories\DocumentRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserReviewRepository;
use Illuminate\Http\Request;
use Throwable;
use Response;
use App\Traits\ApprovalStatus;
use App\Notifications\ReviewStatusChange;


class UsersReviewController extends AppBaseController
{
    use ApprovalStatus;
    private $disk = 'reviews';
    public $documentRepository;
    public $userRepository;
    public $repository;

    public function __construct(DocumentRepository $documentRepo, UserRepository $userRepo, UserReviewRepository $userReviewRepo)
    {
        $this->getEntity(null, $this->disk);
        $this->userRepository = $userRepo;
        $this->documentRepository = $documentRepo;
        $this->documentRepository->setDisk($this->disk);
        $this->repository = $userReviewRepo;
    }

    /**
     * Display a listing of the userReview.
     *
     * @param UsersReviewDatatable $usersReviewDataTable
     * @return Response
     */
    public function index(UsersReviewDatatable $usersReviewDataTable)
    {
        return $usersReviewDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Badge.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Badge in storage.
     *
     * @param CreateBadgeRequest $request
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified Badge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // try {
        //     $user_review = $this->repository->find($id, ['*'], true);
        //     if (empty($user_review)) {
        //         return $this->sendError($this->entity['singular'] . ' not found');
        //     } else {
        //         $modal = view($this->entity['view'] . '.show', ['user_review' => $user_review, 'entity' => $this->entity])->render();
        //         return $this->sendResponse($modal, '');
        //     }
        // } catch (Throwable $e) {
        //     return $this->sendError($e->getMessage(), $e->getCode() ?: 400);
        // }

        try {
            $user_review = $this->repository->find($id, ['*'], true);

            if (empty($user_review)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['user_review' => $user_review, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Badge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified Badge in storage.
     *
     * @param  int              $id
     * @param UpdateBadgeRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $userReview = UserReview::findOrFail($id);
        $status = $request->input('status', 0);

        // Perform additional validation or checks here if needed

        $userReview->approval_status = $status;
        $userReview->save();

        return response()->json(['status' => $status]);
    }


    public function approveReview(Request $request)
    {
        $id = $request->input('id');
        $review = UserReview::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $input = [
            'status' => 1, // Set the approval status to 'approved'
            'apporval_reason' => null, // Assuming there is no specific reason for approval in the request
        ];
        if ($review->status != 1) {
            $this->markApproved($review, $input); // Use the markApproved method from the ApprovalStatus trait

            // Send notification only if the status is changed to 'approved'
            $review->reviewFromUser->notify(new ReviewStatusChange($review));
            $review->reviewToUser->notify(new HootNotification($review));
        }


        $success_message = 'Review approved successfully';

        return redirect()->back()->withInput(['toast_success' => $success_message]);
    }

    public function disapproveReview(Request $request)
    {
        $id = $request->input('id');
        $review = UserReview::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $input = [
            'status' => 0, // Set the approval status to 'rejected'
            'apporval_reason' => null, // Assuming there is no specific reason for rejection in the request
        ];

        $this->markRejected($review, $input); // Use the markRejected method from the ApprovalStatus trait
        $review->reviewFromUser->notify(new ReviewStatusChange($review));
        $success_message = 'Review disapproved successfully';

        return redirect()->back()->withInput(['toast_success' => $success_message]);
    }
    public function getData(Request $request)
    {
        $query = UserReview::query();

        if ($request->has('review_from_id')) {
            $query->where('review_from_id', $request->input('review_from_id'));
        }

        if ($request->has('review_to_id')) {
            $query->where('review_to_id', $request->input('review_to_id'));
        }

        // Add more filtering conditions if needed...

        $data = $query->get();

        return response()->json(['data' => $data]);
    }



}
