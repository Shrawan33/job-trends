<?php

namespace App\Http\Controllers;

use App\Channels\SmsChannel;
use App\Classes\ChatNotification;
use App\Classes\NotifyCandidate;
use App\DataTables\MessageDataTable;
use App\Http\Requests\CreateMessageRequest;
use App\Notifications\SendMessageIndividual;
use App\Repositories\MessageRepository;
use App\Repositories\UserPackageRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class MessageController extends AppBaseController
{
    // /** @var  $repository */
    // public $repository;
    // public $userRepository;
    // public $userPackageRepository;

    // public function __construct(MessageRepository $messageRepo, UserRepository $userRepo, UserPackageRepository $userPackageRepo)
    // {
    //     $this->repository = $messageRepo;
    //     $this->userRepository = $userRepo;
    //     $this->userPackageRepository = $userPackageRepo;
    //     $this->getEntity();
    // }

    // /**
    //  * Display a listing of the Message.
    //  *
    //  * @param MessageDataTable $messageDataTable
    //  * @return Response
    //  */
    // public function index(MessageDataTable $messageDataTable)
    // {
    //     $layout = '';
    //     if (auth()->user()->hasRole('account')) {
    //         $layout = 'admin';
    //     } else {
    //         $layout = 'front';
    //     }
    //     return $messageDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity, 'layout' => $layout]);
    // }

    // /**
    //  * Show the form for creating a new Message.
    //  *
    //  * @return Response
    //  */
    // public function create($id = 0)
    // {
    //     try {
    //         $user = $this->userRepository->find($id, ['*'], true);
    //         $prefix = $this->entity['prefix'] == 'account' ? 'account.' : '';
    //         if (empty($user)) {
    //             return $this->sendError($this->entity['singular'] . ' not found');
    //         }
    //         $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'user' => $user, 'prefix' => $prefix])->render();

    //         return $this->sendResponse($modal, '');
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }

    // public function createGroupMessage(Request $request)
    // {
    //     try {
    //         $ids = request()->get('users', []);
    //         $users = $this->userRepository->all(['id' => $ids]);

    //         $names = $users->implode('full_name', ', ');
    //         $ids = $users->pluck('id')->toJson();

    //         $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'group' => true, 'ids' => $ids, 'names' => $names])->render();

    //         return $this->sendResponse($modal, '');
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }

    // /**
    //  * Store a newly created Message in storage.
    //  *
    //  * @param CreateMessageRequest $request
    //  *
    //  * @return Response
    //  */
    // public function store(Request $request)
    // {
    //     $data = ['subject' => $request->subject ?? '', 'message' => $request->message ?? ''];
    //     $message = trans('message.notification_successfull');
    //     try {
    //         throw_if(empty($request->get('via', [])), BadRequestException::class, trans('message.no_medium_selected'));
    //         $ids = $request->get('group', 0) == 1 ? json_decode($request->get('id', []), true) : [$request->id];
    //         $via = $request->get('via', []);
    //         // reduce credits
    //         if (in_array('sms', $via) && auth()->user()->hasRole('employer')) {
    //             $via = array_map(function ($v) {
    //                 return $v == 'sms' ? SmsChannel::class : $v;
    //             }, $via);
    //             $userPackage = auth()->user()->activeUserPackage;
    //             throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
    //             $remaining = $this->userPackageRepository->getTypeWiseCredit($userPackage, 'sms');
    //             throw_if(count($ids) > $remaining, BadRequestException::class, trans('message.limited_sms_credit', ['credit' => $remaining]));
    //         }

    //         //notification
    //         if ($request->get('group', 0) == 1) {
    //             (new ChatNotification($ids, $data, 'SendMessage', $via))->notify();
    //         } else {
    //             (new ChatNotification($ids, $data, 'SendMessageIndividual', $via))->notify();
    //         }
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), 200);
    //     }
    //     return $this->sendResponse($data, $message);
    // }

    // public function list($user_id, $msg_type)
    // {
    //     try {
    //         if ($msg_type == '1') {
    //             $messages = $this->repository->all(['notifiable_id' => auth()->user()->id, 'sender_id' => $user_id], null, null, ['*'], [], ['created_at' => 'DESC']);
    //         } else {
    //             $messages = $this->repository->all(['notifiable_id' => $user_id, 'sender_id' => auth()->user()->id], null, null, ['*'], [], ['created_at' => 'DESC']);
    //         }

    //         $user = $this->userRepository->find($user_id);
    //         $modal = view($this->entity['view'] . '.message', ['entity' => $this->entity, 'messages' => $messages, 'user' => $user, 'msg_type' => $msg_type])->render();

    //         return $this->sendResponse($modal, '');
    //     } catch (Throwable $e) {
    //         return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
    //     }
    // }



    /** @var  $repository */
    public $repository;
    public $userRepository;
    public $userPackageRepository;

    public function __construct(MessageRepository $messageRepo, UserRepository $userRepo, UserPackageRepository $userPackageRepo)
    {
        $this->repository = $messageRepo;
        $this->userRepository = $userRepo;
        $this->userPackageRepository = $userPackageRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Message.
     *
     * @param MessageDataTable $messageDataTable
     * @return Response
     */
    public function index(MessageDataTable $messageDataTable)
    {
        return $messageDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create($id = 0)
    {
        try {
            $user = $this->userRepository->find($id, ['*'], true);

            $msg_type = 1;

            if ($msg_type == '1') {
                $messages = $this->repository->all(['notifiable_id' => [auth()->user()->id, $user->id], 'sender_id' => [$user->id, auth()->user()->id]], null, null, ['*'], [], ['created_at' => 'ASC']);
                $messages->markAsRead();

            } else {
                $messages = $this->repository->all(['notifiable_id' => $user->id, 'sender_id' => auth()->user()->id], null, null, ['*'], [], ['created_at' => 'ASC']);
            }


            if (empty($user)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'user' => $user, 'msg_type' => $msg_type, 'user_id' => $user->id, 'messages' => $messages])->render();

            $query = $this->repository->allQuery();
            $query->ofTypes(['SendMessage', 'SendMessageIndividual']);

            //dd(DBNotification::OfTypes(['SendMessage', 'SendMessageIndividual'])->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count());
            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    public function createGroupMessage(Request $request)
    {
        try {
            $ids = request()->get('users', []);
            $users = $this->userRepository->all(['id' => $ids]);

            $names = $users->implode('full_name', ', ');
            $ids = $users->pluck('id')->toJson();

            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'group' => true, 'ids' => $ids, 'names' => $names])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
     public function store(Request $request)
    {
        $data = ['subject' => $request->subject ?? '', 'message' => $request->message ?? ''];
        $message = trans('message.notification_successfull');
        try {
            throw_if(empty($request->get('via', [])), BadRequestException::class, trans('message.no_medium_selected'));
            $ids = $request->get('group', 0) == 1 ? json_decode($request->get('id', []), true) : [$request->id];
            $via = $request->get('via', []);
            // reduce credits
            if (in_array('sms', $via) && auth()->user()->hasRole('employer')) {
                $via = array_map(function ($v) {
                    return $v == 'sms' ? SmsChannel::class : $v;
                }, $via);
                $parent_user = Auth::user()->created_by;

                $userPackage = auth()->user()->activeUserPackage($parent_user);
                throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
                $remaining = $this->userPackageRepository->getTypeWiseCredit($userPackage, 'sms');
                throw_if(count($ids) > $remaining, BadRequestException::class, trans('message.limited_sms_credit', ['credit' => $remaining]));
            }

            //notification
            if ($request->get('group', 0) == 1) {
                (new NotifyCandidate($ids, $data, 'SendMessage', $via))->notify();
            } else {
                $user = $this->userRepository->find($request->get('id'));
                if($user->hasRole('employer') == 1)
                {

                    if($user->notify_for_new_messages == 1)
                    {
                        $user->notify(new SendMessageIndividual($data, $via, auth()->user()));
                    }
                    else
                    {
                        $newvia = [];
                        array_push($newvia, 'database');
                        $user->notify(new SendMessageIndividual($data, $newvia, auth()->user()));
                    }
                }
                else
                {
                    $user->notify(new SendMessageIndividual($data, $via, auth()->user()));
                }
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 200);
        }
        //return $this->sendResponse($data, $message);

        $msg_type = 1;

        if ($msg_type == '1') {
            $messages = $this->repository->all(['notifiable_id' => [auth()->user()->id, $user->id], 'sender_id' => [$user->id, auth()->user()->id]], null, null, ['*'], [], ['created_at' => 'ASC']);
        } else {
            $messages = $this->repository->all(['notifiable_id' => $user->id, 'sender_id' => auth()->user()->id], null, null, ['*'], [], ['created_at' => 'ASC']);
        }

        $user->refreshContentId = 'thread_messages';
        $user->refreshContent = view($this->entity['view'] . '.thread', ['model' => $user, 'entity' => $this->entity, 'user' => $user, 'msg_type' => $msg_type, 'user_id' => $user->id, 'messages' => $messages])->render();

        $user->remainOpen = true;
        $user->type = 'class';
        return $this->sendResponse($user, $message);
    }



    public function list($user_id, $msg_type)
    {
        try {
            if ($msg_type == '1') {
                $messages = $this->repository->all(['notifiable_id' => [auth()->user()->id, $user_id], 'sender_id' => [$user_id, auth()->user()->id]], null, null, ['*'], [], ['created_at' => 'ASC']);
            } else {
                $messages = $this->repository->all(['notifiable_id' => $user_id, 'sender_id' => auth()->user()->id], null, null, ['*'], [], ['created_at' => 'ASC']);
            }

            $user = $this->userRepository->find($user_id, ['*'], true);
            $modal = view($this->entity['view'] . '.message', ['entity' => $this->entity, 'messages' => $messages, 'user' => $user, 'msg_type' => $msg_type])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
