<?php

namespace App\Listeners;

use App\Events\NewUser;
use App\Repositories\VerificationCodeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationCodes implements ShouldQueue
{
    private $verificationCodeRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(VerificationCodeRepository $verificationCodeRepository)
    {
        $this->verificationCodeRepository = $verificationCodeRepository;
    }

    /**
     * Handle the event.
     *
     * @param  NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        $this->verificationCodeRepository->startUserRegistration($event->newUser);
    }
}
