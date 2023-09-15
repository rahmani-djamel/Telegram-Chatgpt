<?php

namespace App\Providers;

use App\Services\ChatGpt;
use App\Services\TelegramBot;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('telegram_bot',function(){

            return new TelegramBot();
        });

        $this->app->singleton('chatgpt',function(){

            return new ChatGpt();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
