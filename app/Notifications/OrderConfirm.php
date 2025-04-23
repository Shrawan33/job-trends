<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirm extends Notification implements ShouldQueue
{
    use Queueable;

    public $object;
    public $via;
    public $sender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($object, $via = ['mail', 'database'], $sender = null)
    {
        $this->object = $object;
        $this->via = $via;
        $this->sender = $sender;
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
        return (new MailMessage)->markdown('mail.admin.order_confirm', [
            'order' => $this->object,
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
            'order' => $this->object,
            'notifiable' => $notifiable,
        ];
    }
}
