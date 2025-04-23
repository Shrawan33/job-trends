<?php
namespace App\Traits;

use App\Events\LoginMobileUser;
use App\Events\ResetPasswordThroughEmail;
use App\Models\User;

trait PasswordResetHelper
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
        if ($this->isEmailRequest()) {
            return 'email';
        } else {
            return 'phone_number';
        }
    }

    public function generateEvent(User $user)
    {
        if ($this->isEmailRequest()) {
            event(new ResetPasswordThroughEmail($user));
        } else {
            event(new LoginMobileUser($user));
        }
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
}
