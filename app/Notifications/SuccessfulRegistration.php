<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfulRegistration extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
    public function toMail($notifiable)
    {

        $pdfPath = public_path('pdf/90-Days-Career-Boost-Kit-By-JobTrendsIndia.pdf');

        return (new MailMessage)->markdown('mail.successful_register', [
            'user' => $this->user,
            'notifiable' => $notifiable,

            ])->attach($pdfPath, [
            'as' => 'Career-Boost-Kit.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
