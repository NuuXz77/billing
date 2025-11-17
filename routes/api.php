<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Chatbot routes
Route::prefix('chatbot')->group(function () {
    Route::post('/send', [ChatbotController::class, 'sendMessage']);
    Route::get('/test', [ChatbotController::class, 'testConnection']);
});
