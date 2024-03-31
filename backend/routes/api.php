<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/register',[AuthController::class,'register']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    Route::get('/user/conversations', [ConversationController::class, 'authUserConversations'])->name('user.conversations');
    Route::get('/user/conversations/{id}/messages', [ConversationController::class, 'conversationMessages'])->name('user.conversations');



    Route::post('/send-message', [MessageController::class, 'store'])->name('user.messages.store');
});



Route::get('/event',function(){
    // broadcast(new \App\Events\ChatMessage('user','message'));
    event(new \App\Events\ChatMessage('user','message'));
    // \App\Events\ChatMessage::dispatch('user','message');
    return response()->json('Event sended successfully!');
});
