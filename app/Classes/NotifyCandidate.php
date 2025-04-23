<?php

namespace App\Classes;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Notification;

class NotifyCandidate
{
    private $users;
    private $object;
    private $notification;
    private $via;
    private $userPackage;

    public function __construct($id, $object, $notificationName = 'SendMessage', $via = null)
    {
        $this->setUsers($id);
        $this->object = $object;
        $this->via = $via;
        $this->notification = $this->createNotification($notificationName);
    }

    public function setUsers($id)
    {
        $this->users = User::members(['jobseeker'])->whereIn('id', $id)->get();
    }

    public function notify()
    {
        if ($this->users) {
            // if (!empty($this->via)) {
            //     // dd(get_class_methods(Notification::class), $this->via, $this->users, $this->notification);
            //     // Notification::channel($this->via)->send($this->users, $this->notification);
            //     Notification::sendNow($this->users, $this->notification, $this->via);
            // } else {
            Notification::send($this->users, $this->notification);
            // }
        }
    }

    private function createNotification($notificationName = null)
    {
        try {
            throw_if(empty($notificationName), Exception::class, 'expects parameter $notificationName to be the class name of the Notification.');
            $notification = "App\Notifications\\$notificationName";
            return new $notification($this->object, $this->via, auth()->user());
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
