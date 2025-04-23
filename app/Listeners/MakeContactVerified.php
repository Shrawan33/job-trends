<?php

namespace App\Listeners;

use App\Events\UserContactVerified;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeContactVerified
{
    private $userRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserContactVerified  $event
     * @return void
     */
    public function handle(UserContactVerified $event)
    {
        $this->userRepository->makeUserContactVerified($event->userId, $event->verification);
    }
}
