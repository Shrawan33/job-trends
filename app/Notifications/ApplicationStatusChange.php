<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ApplicationStatusChange extends Notification implements ShouldQueue
{
    use Queueable;

    private $job;
    private $application;
    private $applicant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($jobApplication)
    {
        $this->application = $jobApplication;

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
        ->subject('Your Job Application Status Has Been Updated') // Custom Subject

        ->markdown('mail.job.seeker.application_status_change', [
            'notifiable' => $notifiable,
            'application' => $this->application
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
            'application' => $this->application // jobseeker
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
        return str_replace(['@employer', '@name'], [$notifiable->getName(), $this->applicant->full_name], config('sms.contents.job_application'));
    }
}
