<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewStatusChange extends Notification implements ShouldQueue
{
    use Queueable;

    private $review;
    private $approval_status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($review)
    {
        $this->approval_status = $review;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {

    //     return (new MailMessage)->markdown('mail.Review_status', [
    //         'review' => $this->approval_status, // Use 'review' here instead of 'user'
    //         'notifiable' => $notifiable,
    //     ]);
    // }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->markdown('mail.Review_status', [
                'review' => $this->approval_status, // Use 'review' here instead of 'user'
                'notifiable' => $notifiable,
            ]);
    }
}
