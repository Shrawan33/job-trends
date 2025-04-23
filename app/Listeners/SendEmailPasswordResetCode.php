<?php

namespace App\Listeners;

use App\Events\ResetPasswordThroughEmail;
use App\Repositories\VerificationCodeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailPasswordResetCode implements ShouldQueue
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
     * @param  ResetPasswordThroughEmail  $event
     * @return void
     */
    public function handle(ResetPasswordThroughEmail $event)
    {
        $this->verificationCodeRepository->sendEmailPasswordResetCode($event->user);
    }
}
