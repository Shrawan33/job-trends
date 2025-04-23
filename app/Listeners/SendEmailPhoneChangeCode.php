<?php

namespace App\Listeners;

use App\Events\ChangeEmailThroughEmail;
use App\Repositories\VerificationCodeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

/* verification when user change email and phone number from his/her profile */
class SendEmailPhoneChangeCode implements ShouldQueue

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
     * @param  ChangeEmailThroughEmail  $event
     * @return void
     */
    public function handle(ChangeEmailThroughEmail $event)
    {
        $this->verificationCodeRepository->sendEmailPhoneChangedCode($event->user, $event->type);
    }
}
