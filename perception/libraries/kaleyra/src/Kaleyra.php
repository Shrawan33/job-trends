<?php

namespace Perception\Libraries\Kaleyra;

use Perception\Libraries\Kaleyra\Rest\Client;

class Kaleyra
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message, string $type = 'OTP')
    {
        return $this->client->sendMessage($number, $message, $type);
    }
}
