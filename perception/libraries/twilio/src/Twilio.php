<?php

namespace Perception\Libraries\Twilio;

use Twilio\Rest\Client;

class Twilio
{
    /** @var Twilio\Rest\Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message)
    {
        return $this->client->messages->create($number, [
            'from' => config('twilio.sms_from'),
            'body' => $message
        ]);
    }
}
