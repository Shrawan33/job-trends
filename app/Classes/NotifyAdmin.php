<?php

namespace App\Classes;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Notification;

class NotifyAdmin
{
    private $users;
    private $object;
    private $notification;
    private $via;

    public function __construct($object, $notificationName = 'Report', $via = null)
    {
        $this->setUsers();
        $this->object = $object;
        $this->notification = $this->createNotification($notificationName);
        $this->via = $via;
    }

    public function setUsers()
    {
        $this->users = User::members(['admin'])->get();
    }

    public function notify()
    {
        if ($this->users) {
            if (!empty($this->via)) {
                Notification::channel($this->via)->send($this->users, $this->notification);
            } else {
                Notification::send($this->users, $this->notification);
            }
        }
    }

    private function createNotification($notificationName = null)
    {
        try {
            throw_if(empty($notificationName), Exception::class, 'expects parameter $notificationName to be the class name of the Notification.');
            $notification = "App\Notifications\\$notificationName";
            return new $notification($this->object);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
