<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobEdit extends Notification implements ShouldQueue
{
    use Queueable;

    private $job;
    // private $application;
    // private $applicant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
        // $this->application = $appliedJob;
        // $this->job = $appliedJob->employerJob;
        // $this->applicant = $appliedJob->user;
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
        return (new MailMessage)
            ->subject('Your applied job is now updated')
            ->markdown('mail.job.employer.edit_job', [
                'job' => $this->job,
                'notifiable' => $notifiable,
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
            'job' => $this->job,
            // 'applicant' => $this->applicant // jobseeker
        ];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    // public function toSms($notifiable)
    // {
    //     return str_replace(['@employer', '@name'], [$notifiable->getName(), $this->applicant->full_name], config('sms.contents.job_application'));
    // }
}
