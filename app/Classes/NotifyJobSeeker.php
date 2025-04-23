<?php
namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotifyJobSeeker
{
    private $users;
    private $object;
    private $notification;
    private $via;

    public function __construct($users, $object, $notificationName = 'NewJob', $via = [])
    {
        $this->users = $users;
        $this->object = $object;
        $this->via = $via;
        $this->notification = $this->createNotification($notificationName);
    }

    public function notify()
    {
        Log::info('Sent ', ['notify' => $this->notification]);
        Notification::send($this->users, $this->notification);
    }

    private function createNotification($notificationName = null)
    {
        try {
            throw_if(empty($notificationName), Exception::class, 'expects parameter $notificationName to be the class name of the Notification.');
            $notification = "App\Notifications\\$notificationName";
            return new $notification($this->object, $this->via);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
