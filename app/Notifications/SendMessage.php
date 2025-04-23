<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMessage extends Notification implements ShouldQueue
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
    // , SmsChannel::class
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
        return $this->via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = !empty($this->sender) && $this->sender->hasRole('employer') ? $this->sender->company_name : ($this->sender->full_name ?? null);
        return (new MailMessage)
                ->subject("You have a new message from ".$name)
                ->markdown(
                    'mail.candidate.mail-template',
                    [
                        'message' => $this->object['message'],
                        'notifiable' => $notifiable,
                        'employer' => $this->sender->company_name
                    ]
                );
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
            'candidate_id' => $notifiable->id ?? 0,
            'employer_id' => $this->sender->id ?? 0,
            'subject' => $this->object['subject'] ?? '',
            'message' => $this->object['message'] ?? ''
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
        return str_replace(['@name'], [$notifiable->getName()], config('mail.candidate.mail-template'));
    }
}
