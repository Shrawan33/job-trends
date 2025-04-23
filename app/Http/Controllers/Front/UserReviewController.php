<?php

namespace App\Http\Controllers\Front;

use App\Helpers\FunctionHelper;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserReviewRequest;
use App\Http\Requests\UpdateUserReviewRequest;
use App\Notifications\AdminReviewNotification;
use App\Repositories\DocumentRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserReviewRepository;
use App\Http\Requests\UpdateUserReviewReRequest;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Repositories\BadgeRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserReviewController extends AppBaseController
{
    private $disk = 'reviews';
    public $documentRepository;
    public $userRepository;
    public $repository;
    public $badgeRepository;


    public function __construct(DocumentRepository $documentRepo, BadgeRepository $BadgeRepo, UserRepository $userRepo, UserReviewRepository $userReviewRepo)
    {
        $this->getEntity(null, $this->disk);
        $this->userRepository = $userRepo;
        $this->documentRepository = $documentRepo;
        $this->documentRepository->setDisk($this->disk);
        $this->repository = $userReviewRepo;
        $this->badgeRepository = $BadgeRepo;

    }

    /**
     * Show the form for creating a new UserReview.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        try {

            //dd($request->get('id'));
            //dd($request->get('id'));
            $record = $this->userRepository->find($request->get('id'), ['*'], true);
            $search = ['review_from_id' => Auth::user()->id, 'review_to_id' => $request->get('id')];
            $review = $this->repository->all($search, null, null, ['*'], [], ['created_at' => 'ASC']);
            $basic_review_count = $review->where('review_type', 1)->count();
            $advance_review_count = $review->where('review_type', 2)->count();

            $review_count = ['basic_review_count' => $basic_review_count, 'advance_review_count' => $advance_review_count];
            if (empty($record)) {
                return $this->sendError('record not found');
            }
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'record' => $record, 'view' => $request->get('entity'), 'review_count' => $review_count])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }


    public function edit($id)
    {
        try {

            // Find the review record with the given ID
            $review = $this->repository->find($id, ['*'], true);

            if (empty($review)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }

            // Assuming the candidate_id is associated with the review model
            $candidate_id = $review->candidate_id;

            // Retrieve the badges related to the candidate
            $badges = $this->badgeRepository->getBadges($candidate_id);

            // Set the selectedBadgeId based on your logic here
            $selectedBadgeId = $review->badge_id;

            // Render the view and pass data to it
            $modal = view($this->entity['view'] . '.edit', [
                'id' => $id,
                'review' => $review,
                'entity' => $this->entity,
                'badges' => $badges,
                'selectedBadgeId' => $selectedBadgeId,
                'strengthAttributes' => $review->badge_strength,
                'weaknessAttributes' => $review->badge_weakness, // Assuming this is the correct attribute name
            ])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
    /**
     * Store a newly created UserReview in storage.
     *
     * @param CreateUserReviewRequest $request
     *
     * @return Response
     */
    public function store(CreateUserReviewRequest $request)
    {
        try {
            $input = $request->all();

            //dd($input);

            $input['review_from_id'] = Auth::user()->id;

            if ($request->get('active_tab') == 'basic-tab') {
                $input['review'] = $request->get('basic_review');
                $input['is_anonymous'] = $request->get('basic_anonymous') ?? 0;
            } else {
                $input['review'] = $request->get('advance_review');
                $input['is_anonymous'] = $request->get('advance_anonymous') ?? 0;
                $input['badge_weekness'] = $request->get('weeknesses');
                $input['badge_strength'] = $request->get('responsibilities');
            }
            // dd($input);
            $userReview = $this->repository->create($input);

            if ($request->get('active_tab') == 'basic-tab') {
                // video upload
                $document = $request->get('basic_video', []);
                $doc_type = config('constants.document_type.video', 3);
                $this->documentRepository->savePermanent($document, $doc_type, $userReview);

                // audio upload
                $document = $request->get('basic_audio', []);
                $doc_type = config('constants.document_type.audio', 4);
                $this->documentRepository->savePermanent($document, $doc_type, $userReview);

                if (isset($input['basic_review_image_file'])) {
                    $image = $input['basic_review_image_file'];
                    $imageData = file_get_contents($image->getRealPath()); // Read the content of the file
                    $base64Image = base64_encode($imageData);
                    $mimeType = $image->getMimeType(); // Get the MIME type of the uploaded file
                    $dataUri = 'data:' . $mimeType . ';base64,' . $base64Image;

                    $images['id'][] = '0';
                    $images['image'][] = $dataUri;

                    //$image = $request->get('jobseeker_logo', []);
                    $doc_type = config('constants.document_type.image', 0);
                    $this->documentRepository->savePermanent($images, $doc_type, $userReview);
                }

            } else {
                $document = $request->get('advance_video', []);
                $doc_type = config('constants.document_type.video', 3);
                $this->documentRepository->savePermanent($document, $doc_type, $userReview);

                // audio upload
                $document = $request->get('advance_audio', []);
                $doc_type = config('constants.document_type.audio', 4);
                $this->documentRepository->savePermanent($document, $doc_type, $userReview);

                if (isset($input['advance_review_image_file'])) {
                    $image = $input['advance_review_image_file'];
                    $imageData = file_get_contents($image->getRealPath()); // Read the content of the file
                    $base64Image = base64_encode($imageData);
                    $mimeType = $image->getMimeType(); // Get the MIME type of the uploaded file
                    $dataUri = 'data:' . $mimeType . ';base64,' . $base64Image;

                    $images['id'][] = '0';
                    $images['image'][] = $dataUri;

                    //$image = $request->get('jobseeker_logo', []);
                    $doc_type = config('constants.document_type.image', 0);
                    $this->documentRepository->savePermanent($images, $doc_type, $userReview);
                }
            }

            $adminEmail = 'shahdigs007@yahoo.com'; // Replace with the actual admin email address
            Mail::to($adminEmail)->send(new AdminReviewNotification($userReview));
            return $this->sendResponse($userReview, $this->entity['singular'] . ' saved successfully and under admin approval. It will available shortly once admin approve it.');
        } catch (Throwable $e) {
            throw $e;
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function feed(Request $request)
    {
        $input = $request->input();
        $reviewed_users = $this->userRepository->basicReviews();
        //dd($this->entity['view']);
        return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'input' => $input, 'reviewed_users' => $reviewed_users]);
    }

    public function loadMoreFeed(Request $request)
    {
        $input = $request->input();
        $reviewed_users = $this->userRepository->basicReviews();

        return view('components.review_to_user_list', ['reviewed_users' => $reviewed_users]);
    }

    public function getRevieweFromUserList($user_id)
    {
        $record = $this->userRepository->find($user_id, ['*'], true);
        $record->refreshContentId = 'user-review-list';
        $record->refreshContent = view('components.user_basic_reviews', ['reviews' => $record->review])->render();

        $success_message = '';
        return $this->sendResponse($record, $success_message);

    }

    public function getAdvanceReviewsByCurrentUser()
    {
        try {
            $this->entity = FunctionHelper::getEntity('userReviews');
            //dd($this->entity);
            $userId = Auth::user()->id;
            // Query to get all advance reviews given by the current user
            $advanceReviews = $this->repository->all(['review_from_id' => $userId, 'review_type' => 2]);
            // dd($advanceReviews);
            return view('user_reviews.advanceReviewsByCurrentUser', ['advanceReviews' => $advanceReviews, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }





    public function update($id, UpdateUserReviewRequest $request)
    {
        $input = $request->all();
        try {
            $userReview = $this->repository->find($id);

            if (empty($userReview)) {
                return $this->sendError($this->entity['singular'] . ' not found', 404);
            }

            // Define the fields you want to update explicitly
            $updateData = [
                'badge_id' => $request->input('badge_id'),
                // Add more fields here as needed
            ];

            // Check the active tab to determine which review data to update

            $updateData['review'] = $request->get('advance_review');
            $updateData['is_anonymous'] = $request->get('advance_anonymous') ?? 0;
            $updateData['badge_weekness'] = $request->get('weeknesses');
            $updateData['badge_strength'] = $request->get('responsibilities');

            $document = $request->get('advance_video', []);
            $doc_type = config('constants.document_type.video', 3);
            $this->documentRepository->savePermanent($document, $doc_type, $userReview);

            // audio upload
            $document = $request->get('advance_audio', []);
            $doc_type = config('constants.document_type.audio', 4);
            $this->documentRepository->savePermanent($document, $doc_type, $userReview);

            // Update the user review with the specified fields
            $userReview->update($updateData);
            return $this->sendResponse(['callbackFunction' => "reloadData('userReviews.advanceReviewsByCurrentUser');",], $this->entity['singular'] . ' updated successfully.');



        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }





}
