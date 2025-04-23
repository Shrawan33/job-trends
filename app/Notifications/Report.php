<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Report extends Notification implements ShouldQueue
{
    use Queueable;

    private $report;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
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
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.admin.report', [
            'report' => $this->report,
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
            'report_id' => !empty($this->report) ? $this->report->id : 0,
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
    //     return str_replace(['@name'], [$notifiable->getName()], config('sms.contents.new_job'));
    // }
}
