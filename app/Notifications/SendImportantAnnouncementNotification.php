<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendImportantAnnouncementNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    public $senderDetails;
    public $subject;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($senderDetails, $subject, $message)
    {
        $this->senderDetails = $senderDetails;
        $this->subject = $subject;
        $this->message = $message;
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
        // $content = $this->replaceContent($this->emailTemplate->content);
        $subject = $this->subject ?? config('constants.important_announcement_subject');
        $content = $this->message??'';
        return (new MailMessage)->subject($subject)->markdown('mail.common.mail_content', [
            'notifiable' => $notifiable,
            'content' => $content
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
            'message' => $this->message
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
        return [
            //
        ];
    }

    public function replaceContent($content)
    {
        return  str_replace(
            [
                '{name}',
                '{message}',
            ],
            [
                $this->senderDetails->getName(),
                $this->message ?? null,
            ],
            $content
        );
    }
}
