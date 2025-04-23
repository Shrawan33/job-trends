<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApplication extends Notification implements ShouldQueue
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
    public function __construct($appliedJob)
    {
        $this->application = $appliedJob;
        $this->job = $appliedJob->employerJob;
        $this->applicant = $appliedJob->user;
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
        if($notifiable->hasRole('jobseeker')){
            return (new MailMessage)
            ->subject('Your Job Application Has Been Submitted!') // 🆕 Custom subject
            ->markdown('mail.job.employer.application', [
                'job' => $this->job,
                'application' => $this->application,
                'applicant' => $this->applicant
            ]);
        }
        if($notifiable->hasRole('employer')){
            return (new MailMessage)
            ->subject('New Job Application for ' . $this->job->title . ' - ' . $this->applicant->full_name)
            ->markdown('mail.job.employer.apply_job', [
                'job' => $this->job,
                'notifiable' => $notifiable,
                'applicant' => $this->applicant,
                'application' => $this->applicant
            ]);
        }

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
            'applicant' => $this->applicant // jobseeker
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
