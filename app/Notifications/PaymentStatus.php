<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentStatus extends Notification implements ShouldQueue
{
    use Queueable;

    // private $entity_type;
    private $package;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $package = null)
    {
        // $this->entity_type = trans("label.payment.entity_types.{$type}");
        // $this->entity_type = $type;
        $this->package = $package;
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
        return (new MailMessage)->subject('Payment Confirmation – Your JobTrendsIndia Subscription is Active!')->markdown('mail.payment', [
            // 'entity_type' => $this->entity_type,
            'package' => $this->package,
            'user' => $notifiable,
        ]);
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
