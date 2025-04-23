<?php

namespace Perception\Libraries\Plivo\Facades;

use Illuminate\Support\Facades\Facade;

class Plivo extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'plivo';
    }
}
