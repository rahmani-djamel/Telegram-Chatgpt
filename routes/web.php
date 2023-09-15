<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');


Route::namespace('App\Livewire\Backend')->group(function() {

        // Home
        Route::namespace('Telegram')->prefix('telegram')->as('telegram.')->group(function() {

            // Home
            Route::get('/', Index::class)->name('sendmessage');
        
        });

    });
    