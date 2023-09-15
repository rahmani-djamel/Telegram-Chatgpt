<?php

namespace App\Livewire\Backend\Telegram;

use Livewire\Component;
use Telegram\Bot\Laravel\Facades\Telegram;

class Index extends Component
{
    public function mount()
    {
        $updates = Telegram::getUpdates();
      //  dd($updates);
        $bot = Telegram::getMe();

        //dd($bot);
        $text = "<strong>Hello Rahmani this message is from laravel </strong>";

       
        Telegram::sendMessage([
            'chat_id' => '-1001539969585',
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

       
    }
    public function render()
    {
        return view('livewire.backend.telegram.index');
    }

}
