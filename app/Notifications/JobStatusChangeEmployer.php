<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobStatusChangeEmployer extends Notification implements ShouldQueue
{
    use Queueable;

    private $job;
    private $status;
    private $application;
    private $applicant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job, $status)
    {
        $this->job = $job;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
        return (new MailMessage)->markdown('mail.job.employer.job_status_change', [
            'notifiable' => $notifiable,
            'job' => $this->job,
            'status' => $this->status
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
            'notifiable' => $notifiable, // employer
            'job' => $this->job, // jobseeker
            'status' => $this->status
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
    //     return str_replace(['@employer', '@name'], [$notifiable->getName(), $this->applicant->full_name], config('sms.contents.job_application'));
    }
}
