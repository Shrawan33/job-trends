<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PackageExpiredReminder extends Notification implements ShouldQueue
{
    use Queueable;
    private $package;
    private $event;
    public $via;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // , SmsChannel::class
    public function __construct($package, $via = ['mail'], $sender = null, $event = 'beforeEndDate')
    {
        $this->package = $package;
        $this->event = $event;
        $this->via = $via;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $duration = '';
        $template = 'mail.employer.packageExpired';
        if ($this->event == 'beforeEndDate') {
            $template = 'mail.employer.beforeExpiredPackage';
            $duration = config('constants.duration_package_day.before_end_date');
        } elseif ($this->event == 'beforeGraceDate') {
            $template = 'mail.employer.beforeGraceExpiredPackage';
            $duration = config('constants.duration_package_day.before_grace_date');
        }

        return (new MailMessage)->markdown($template, [
            'package' => $this->package,
            'notifiable' => $notifiable,
            'duration' => $duration
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        if ($this->event == 'beforeEndDate') {
            $template = 'sms.contents.package_expired_end_date';
        } elseif ($this->event == 'beforeGraceDate') {
            $template = 'sms.contents.package_expired_grace_date';
        } else {
            $template = 'sms.contents.package_expired';
        }
        return str_replace(['@name'], [$notifiable->getName()], config($template));
    }
}
