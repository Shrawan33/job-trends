<?php
namespace App\Listeners;

use App\Events\LoginMobileUser;
use App\Repositories\VerificationCodeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendMobileOtp implements ShouldQueue
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
     * @param  LoginMobileUser  $event
     * @return void
     */
    public function handle(LoginMobileUser $event)
    {
        Log::info('SendSMS SendMobile class ', ['event' => $event]);
        $this->verificationCodeRepository->sendOtp($event->user);
    }
}
