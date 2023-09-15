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
    public function covertTextToVoice($text)
    {
        $url = "http://api.voicerss.org/";
        $result = [];

        try {
            $result = Http::withHeaders($this->headers)->get($url,  [
                    'key' => env('VOICE_RSS_API_KEY'),
                    'src' => $text,
                    'hl' => 'en-us',
                    'c' => 'OGG',
            ]);

            $result = $result->getBody()->getContents();

        } catch (\Throwable $th) {
            $result['error'] = $th->getMessage();
        }
       // Log::info('TeleramBot->converttext->result',['result' => $result]);


        return $result;
    }

    public function sendVoice($text,$telegramChatId,$reply_to_message_id)
    {
        $url = $this->api_endpoint.$this->token."/sendVoice";

        $result = [];

        $voice = $this->covertTextToVoice($text);

        try {
            $result = Http::withHeaders($this->headers)->post($url, [
                'voice' => $voice,
                'chat_id' => $telegramChatId,
                'reply_to_message_id' => $reply_to_message_id
            ]);
            $result = ['status' => $result->ok(),'data' => $result->json()];

        } catch (\Throwable $th) {
            $result['error'] = $th->getMessage();

            //throw $th;
        }



        Log::info('TeleramBot->sendVoice->result',['result' => $voice]);

        return $result;


    }
}

