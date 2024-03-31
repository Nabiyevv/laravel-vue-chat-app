<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('user_id') && $request->has('message') && $request->has('receiver_id')) {
            if ($request->receiver_id == auth()->user()->id) {
                return response()->json([
                    'message' => 'You cannot send a message to yourself'
                ], 400);
            }

            $messageData = Message::create([
                'message' => $request->message,
                'receiver_id' => $request->receiver_id,
                'conversation_id' => $request->conversation_id,
                'type' => 'text',
                'sender_id' => auth(
                )->user()->id,
            ]);

            broadcast(new ChatMessage(auth()->user(),$messageData));

            return response()->json([
                'message' => 'Message created successfully'
            ], 201);
        } else
            return response()->json([
                'message' => 'Somethisng get Wrongs'
            ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
