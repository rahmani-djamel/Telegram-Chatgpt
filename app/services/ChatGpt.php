<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatGpt {

    protected $headers;
    protected $token;


    public function __construct()
    {
      $this->setHeaders();
        
    }
    protected function setHeaders()
    {
        
        $this->headers = [
            "Content-Type"  => "application/json",
            "Authorization"  => "Bearer ".env('CHAT_GPT_KEY'),
        ];

    }
    public function AskQuestion($message)
    {
        $url = env('CHAT_GPT_ENDPOINT');
        $result = [];
        try {
            $response = Http::withHeaders($this->headers)->post($url,
            [
                "model" => "gpt-3.5-turbo",
                "messages" => 
                [
                    [
                        "role" => "user",
                        "content" => $message
                    ]
                ],
                

            ]);

            $result = ['status' => $response->ok(),'data' => $response->json()];

        } catch (\Throwable $th) {
            $result['error'] = $th->getMessage();

            //throw $th;
        }
        Log::info('ChatGpt->AskQuestion->result',['result' => $result]);

        return $result;

    }

}