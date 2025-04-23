<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReviewNotification extends Mailable
{
    use Queueable, SerializesModels;

    // Add any necessary properties and constructor here
    protected $userReview;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $userReview
     * @return void
     */
    public function __construct($userReview)
    {
        $this->userReview = $userReview;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Define the email content and template here
        return $this->markdown('mail.admin_review_notification')
            ->with(['userReview' => $this->userReview]);
    }
}
