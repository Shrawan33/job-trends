<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewJob extends Notification
{
    use Queueable;

    private $job;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
        // , SmsChannel::class
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.job.seeker.new_job', [
            'job' => $this->job,
            'notifiable' => $notifiable
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $notifiable->id,
            'job_id' => !empty($this->job) ? $this->job->id : 0,
        ];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public function toSms($notifiable)
    {
        return str_replace(['@name'], [$notifiable->getName()], config('sms.contents.new_job'));
    }
}
