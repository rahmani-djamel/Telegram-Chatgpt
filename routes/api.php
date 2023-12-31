<?php

use App\Http\Controllers\api\telegram\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('telegram/webhook')->group(function() {
    Route::post('inbound',[Index::class,'inbound']);

});


//https://api.telegram.org/bot6447220916:AAG6O9e65oyIzkEZiwZnFmt13cZZWnKZN1k/setWebhook?url=https://e136-41-107-83-33.ngrok-free.app/api/telegram/webhook/inbound
