<?php
namespace App\Traits;

trait Sms
{
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function getName()
    {
        return $this->name;
    }
}
