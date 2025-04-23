<?php

namespace App\Classes;


use Illuminate\Support\Facades\Log;

use Exception;
use Illuminate\Support\Facades\Http;
use stdClass;

class ChatGpt
{
    private $apiKey;
    protected $model; // Add model property

    public function __construct($data=null)
    {
        $this->apiKey = config('services.openai.secret_key');
        //$this->model = 'gpt-3.5-turbo'; // Specify the model
        $this->model = 'gpt-4-1106-preview'; // Specify the model

    }

    public function sendMessage($message)
    {
        //dd($this->apiKey);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $this->model, // Include the model parameter
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant.',
                ],
                [
                    'role' => 'user',
                    'content' => $message,
                ],
            ],
        ]);

        $assistantReply = $response->json('choices.0.message.content');
        //dd($assistantReply['choices'][0]['message']['content']);
        return $assistantReply['choices'][0]['message']['content'];
    }
}
