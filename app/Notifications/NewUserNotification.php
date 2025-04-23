<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Markdown;

class NewUserNotification extends Notification
{
    use Queueable;
    private $new_user;
    private $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($new_user,$password)
    {
        $this->new_user = $new_user;
        $this->password = $password;

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
        $url = route('login');

        return (new MailMessage())
            ->subject('Welcome to Your Website')
            ->line('Dear ' . $notifiable->name . ',')
            ->line('Welcome to our website! An admin has created an account for you.')
            ->line('You can now log in using the following credentials:')
            ->line('Email: ' . $notifiable->email)
            ->line('Password: ' . $this->password)
            ->line('Click the link below to login with the provided Email & Password:')
            ->action('Login', $url)
            ->line('Please remember to change your password after logging in.')
            ->line('Thank you for joining us!')
            ->line('Best regards,')
            ->line('Your Website Team');
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
        'message' => 'An admin has created an account for you.',
        'type' => 'new_user',
        'data' => [
            // Additional data you want to include
        ],
    ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return (new MailMessage())->markdown('mail.successful_new_user', [
            'user' => $this->new_user,
            'notifiable' => $notifiable,
        ]);
    }
}
