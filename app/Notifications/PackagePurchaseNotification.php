<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackagePurchaseNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // Add any necessary properties and constructor here
    protected $user;
    protected $link;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $userReview
     * @return void
     */
    public function __construct($user, $link ='')
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Define the email content and template here
        return $this->subject("Your Resume Writing Package Purchase Confirmation")
            ->markdown('mail.package_purchase_notification')
            ->with(['user' => $this->user, 'link' => $this->link]);
    }
}
