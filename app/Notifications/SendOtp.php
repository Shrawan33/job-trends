<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtp extends Notification
{
    use Queueable;

    private $userVerification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userVerification)
    {
        $this->userVerification = $userVerification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public function toSms($notifiable)
    {
        return str_replace(
            [
                '@name',
                '@code'
            ],
            [
                $notifiable->getName(),
                $this->userVerification->getMobileVerificationCode()
            ],
            config('sms.contents.mobile_otp')
        );
    }
}
