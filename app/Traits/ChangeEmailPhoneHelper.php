<?php

namespace App\Traits;

use App\Events\ChangeEmailThroughEmail;
use App\Models\User;

/**
 * chnage email and phone function
 */
trait ChangeEmailPhoneHelper
{
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function isEmailRequest()
    {
        return !empty($this->email);
    }

    public function getUser()
    {
        if ($this->isEmailRequest()) {
            return User::whereEmail($this->email)->first();
        } else {
            return User::wherePhoneNumber($this->phoneNumber)->first();
        }
    }

    public function getField()
    {
        if ($this->isEmailRequest() || request()->get('email')) {
            return 'email';
        } else {
            return 'phone_number';
        }
    }

    public function generateEvent(User $user, $is_email_change_request = true)
    {
        // dd($is_email_change_request);
        event(new ChangeEmailThroughEmail($user, $is_email_change_request ? 'change_email' : 'change_mobile'));
    }

    public function getExtraRequestData() : array
    {
        if ($this->isEmailRequest()) {
            return [
                'verification' => 'email'
            ];
        } else {
            return [
                'verification' => 'phone',
            ];
        }
    }

    public function alreadyExistCredentials($email = null, $phone = null)
    {
        if ($email) {
            return User::whereEmail($email)->where('id', '!=', auth()->user()->id)->first();
        } else {
            return User::wherePhoneNumber($phone)->where('id', '!=', auth()->user()->id)->first();
        }
    }
}
