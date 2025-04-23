<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVerificationCodes extends Notification
{
    use Queueable;

    private $userVerification;
    private $viaChannel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userVerification, $viaChannel)
    {
        $this->userVerification = $userVerification;
        $this->viaChannel = $viaChannel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (!empty($this->viaChannel) && is_array($this->viaChannel)) {
            return $this->viaChannel;
        }

        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Verify Email For '. config('app.name'))->markdown('mail.user_verification.verification_code', [
            'userVerification' => $this->userVerification,
            'notifiable' => $notifiable
        ]);
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
            config('sms.contents.mobile_verification')
        );
    }
}
