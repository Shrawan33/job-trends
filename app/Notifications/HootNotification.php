<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HootNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $hoot;

    public function __construct($hoot = null)
    {
        $this->hoot = $hoot;
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
    return (new MailMessage)
        ->subject('🎉 You’ve Received a Hoot! See What Your Peers Say About You!')
        ->greeting('Dear ' . $notifiable->first_name.' '.$notifiable->last_name.',')
        ->line('Great news! You’ve just received a Hoot! on JobTrendsIndia from your peers.')
        ->line('Your professional credibility is growing, and recruiters are taking notice. Here’s what this means for you:')
        ->line('✅ Improved visibility to potential employers')
        ->line('✅ Authentic peer-based endorsements of your work style')
        ->line('✅ A stronger, more attractive profile')
        ->action('🔗 View Your Hoot Now',route('userReviews.feed'))
        ->line('Keep engaging, keep growing, and let your skills shine!')
        ->salutation('Best regards,
                JobTrendsIndia Team');
}


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
