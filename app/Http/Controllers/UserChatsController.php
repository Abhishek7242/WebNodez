<?php

namespace App\Http\Controllers;

use App\Models\UserChat;
use Illuminate\Http\Request;

class UserChatsController extends Controller
{
    //
    public function storeMessage(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|uuid',
            'sender' => 'required|in:user,ai',
            'message' => 'required|string',
        ]);

        $chat = UserChat::firstOrCreate([
            'visitor_id' => $request->visitor_id,
        ]);

        $chat->messages()->create([
            'sender' => $request->sender,
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'Message stored']);
    }
}
