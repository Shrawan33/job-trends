<?php
namespace App\Channels;

use App\Events\CreditUtilizationEvent;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Perception\Libraries\Kaleyra\Kaleyra;
// use Perception\Libraries\Kaleyra\Facades\Kaleyra;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SmsChannel
{
    protected $client;

    public function __construct(Kaleyra $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification)
    {
        try {
            $message = $notification->toSms($notifiable);
            $to = $notifiable->getPhoneNumber();

            /**
             * Digant @ 28-July-2021
             * We need to comment below feature because client want to send SMS only for the Registration, Login and Forget Password Feature.
             * Where the credit deduction not required at all.
             * if in future, client wants credit deduction on certain action then we need to omit the below listed Notification Classes in deduction logic
             * Classes: [Notifications/SendVerificationCodes]
             */
            // // employer: deduct credit
            // if ($notification->sender->hasRole(['employer'])) {
            //     $userPackage = $notification->sender->activeUserPackage;
            //     throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
            //     CreditUtilizationEvent::dispatch($notifiable, $userPackage, 'sms');
            // }
            Log::info('Begin SMS:', ['request' => [$to, $message]]);

            $response = $this->client->notify($to, $message, 'OTP');
            Log::info('After SMS:', ['response' => $response]);
            return $response;
        } catch (\Throwable $th) {
            Log::info('Error SMS:', ['response' => $th->getMessage()]);
            return $th->getMessage();
        }
    }
}
