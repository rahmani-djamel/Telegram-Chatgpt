<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBot {
    protected $token;
    protected $api_endpoint;
    protected $headers;

    public function __construct()
    {
        //https://api.telegram.org/bot{token}/sendMessage
        $this->token        = env('TELEGRAM_BOT_TOKEN');
        $this->api_endpoint = env('TELEGRAM_API_ENDPOINT');
        $this->setHeaders();
    }

    protected function setHeaders(){
        
        $this->headers = [
            "Content-Type"  => "application/json",
            "Accept"        => "application/json",
        ];

    }

    public function sendMessage($text = '',$chat_id,$reply_to_message_id)
    {
        $url = $this->api_endpoint.$this->token."/sendMessage";
        $result = [];

        try {
            $result = Http::withHeaders($this->headers)->post($url, [
                'text' => $text,
                'chat_id' => $chat_id,
                'reply_to_message_id' => $reply_to_message_id
            ]);
            $result = ['status' => $result->ok(),'data' => $result->json()];

        } catch (\Throwable $th) {
            $result['error'] = $th->getMessage();

            //throw $th;
        }
        Log::info('TeleramBot->sendMessage->result',['result' => $result]);

    }
}