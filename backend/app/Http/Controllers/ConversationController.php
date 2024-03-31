<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{

    public function authUserConversations()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Conversations not found!',
                'data' => []
            ], 404);
        }

        // $conversations = Conversation::with('messages')->whereAny(['sender_id','receiver_id'],$user->id)->latest('updated_at')->get();

        $conversations = $user->conversations()->latest('updated_at')->get();

        $userConversations = [];

        foreach ($conversations as $conversation) {
            $conversation['receiver_name'] = $conversation->getReceiverUser()->name;
            $userConversations[] = $conversation;
        }


        return response()->json([
            'status' => true,
            'message' => 'Conversations found',
            'data' => $conversations
        ], 200);
    }


    public function conversationMessages($id)
    {
        $conversationMessages = Conversation::with('messages')->find($id);

        if ($conversationMessages && $conversationMessages->messages->count() > 0){

            return response()->json([
                'status' => true,
                'message' => 'Messages found',
                'data' => $conversationMessages
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Messages not found!',
            'data' => []
        ], 404);
    }


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
        //
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
