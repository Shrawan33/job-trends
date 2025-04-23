<?php

namespace Perception\Libraries\Plivo;

use Plivo\RestClient;

class Plivo
{
    private $client;

    public function __construct(RestClient $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message)
    {
        return $this->client->messages->create(
                config('plivo.sms_from'),
                [$number],
                $message
        );
    }
}
