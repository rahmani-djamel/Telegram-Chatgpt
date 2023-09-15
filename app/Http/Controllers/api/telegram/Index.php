<?php

namespace App\Http\Controllers\api\telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Index extends Controller
{
    function inbound(Request $request)  {

        Log::info($request->all()); 

        $chat_id = $request->message['from']['id'];
        $reply_to_message = $request->message['message_id'];

        // first welcome message if it's first time
        //if chat is photo  -> extract text from photo
        //else default message

        if (!cache()->has("chat_id_{$chat_id}")) {
            $text = "Welcome to my bot";
            cache()->put("chat_id_{$chat_id}",true,now()->addMinutes(60));
            # code...
        } elseif (1 == 2) {
            # code...
        }else{

            $text = "how i can help you";

        }

       $result = app('telegram_bot')->sendMessage($text,$chat_id,$reply_to_message);

        return response()->json($result,200);
        
        
    }
}
