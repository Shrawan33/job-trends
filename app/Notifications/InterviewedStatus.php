<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterviewedStatus extends Notification implements ShouldQueue
{
    use Queueable;

    private $job;
    private $company;
    private $interviewType;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job, $company, $interviewType)
    {
        $this->job = $job;
        $this->company = $company;
        $this->interviewType = $interviewType;
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
        return (new MailMessage)->subject('Interview Schedule')->markdown('mail.candidate.interviewedStatus', [
            'notifiable' => $notifiable,
            'job' => $this->job,
            'company_name' => $this->company->first_name .' '. $this->company->last_name,
            'location' => $this->job->location_address ? $this->job->location_address : '',
            'interview' => $this->interviewType,
            'title' => $this->job->title,
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
            'notifiable' => $notifiable,
            'job' => $this->job,
            'company_name' => $this->company->first_name .' '. $this->company->last_name,
            'location' => $this->job->location_address ? $this->job->location_address : '',
            'interview' => $this->interviewType,
            'title' => $this->job->title,
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
        //return str_replace(['@employer', '@name'], [$notifiable->getName(), $this->applicant->full_name], config('sms.contents.job_application'));
    }
}
