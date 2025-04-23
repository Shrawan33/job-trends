<?php

namespace Perception\Libraries\Twilio\Facades;

use Illuminate\Support\Facades\Facade;

class Twilio extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'twilio';
    }
}
