<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewMessage;


class MessagesController extends Controller
{
    public function store(Request $request)
    {
        // Create and save the new message
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->conversation_id = $request->input('conversation_id'); // Get conversation ID from the request
        $message->content = $request->input('content'); // Get message content from the request
        $message->save();

        // Broadcast the NewMessage event
        event(new NewMessage($message));

        return response()->json(['message' => 'Message sent successfully']);
    }
    public function sendMessage(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'content' => 'required|string',
        ]);

        // Create and save the new message
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->conversation_id = $validatedData['conversation_id'];
        $message->content = $validatedData['content'];
        $message->save();

        // Broadcast the NewMessage event
        event(new NewMessage($message));

        return response()->json(['message' => 'Message sent successfully']);
    }

}
