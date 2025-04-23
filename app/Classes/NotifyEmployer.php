<?php

namespace App\Classes;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Notification;

class NotifyEmployer
{
    private $users;
    private $object;
    private $notification;
    private $via;
    private $eventName;

    public function __construct($ids, $object, $notificationName = 'PackageExpiredReminder', $via = null, $event = '')
    {
        $this->setUsers($ids);
        $this->object = $object;
        $this->via = $via;
        $this->eventName = $event;
        $this->notification = $this->createNotification($notificationName);
    }

    public function setUsers($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        $this->users = User::members(['employer'])->whereIn('id', $ids)->get();
    }

    public function notify()
    {
        if ($this->users) {
            Notification::send($this->users, $this->notification);
        }
    }

    private function createNotification($notificationName = null)
    {
        try {
            throw_if(empty($notificationName), Exception::class, 'expects parameter $notificationName to be the class name of the Notification.');
            $notification = "App\Notifications\\$notificationName";
            return new $notification($this->object, $this->via, auth()->user(), $this->eventName);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
