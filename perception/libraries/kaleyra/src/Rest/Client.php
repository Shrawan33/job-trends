<?php

namespace Perception\Libraries\Kaleyra\Rest;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Client
{
    private $headers;
    private $url;
    private $body;

    public function __construct($api_key, $sid, $domain, $sender, $source)
    {
        $this->headers = ['api-key' => $api_key, 'Content-Type' => 'application/json'];
        $this->url = "$domain/{$sid}/messages";
        $this->body = ['sender' => $sender, 'source' => $source];
    }

    public function sendMessage($to, $message, $type = 'OTP')
    {
        $this->body = array_merge($this->body, ['to' => $to, 'body' => $message, 'type' => $type]);
        $data = Http::withHeaders($this->headers)->post($this->url, $this->body)->json();
        if (!empty($data['error'] ?? [])) {
            Log::error("SMS Error({$data['code']}): " . $data['message'], [['request' => ['header' => $this->headers, 'form' => $this->body], 'response' => $data]]);
        } else {
            Log::info('SMS Sent: ' . $to, [['request' => ['header' => $this->headers, 'form' => $this->body], 'response' => $data]]);
        }
        return $data;
    }
}
