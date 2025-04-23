<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Inquiry extends Notification
{
    use Queueable;

    private $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
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
        return (new MailMessage)
                    ->subject('Inquiry from ' . $this->contact['role'] ?? 'Employer')
                    ->markdown('mail.admin.inquiry', [
                        'contact' => $this->contact,
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
            'contact' => $this->contact ?? '',
        ];
    }
}
