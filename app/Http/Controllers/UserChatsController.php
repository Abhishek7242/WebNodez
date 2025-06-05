<?php

namespace App\Http\Controllers;

use App\Models\UserChat;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

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

    public function oldMessage(Request $request, $visitor_id)
    {
        $chat = UserChat::where('visitor_id', $visitor_id)
            ->with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->first();

        if (!$chat) {
            return response()->json([]);
        }

        return response()->json($chat->messages);
    }


    public function userAIChats()
    {
        $user = auth()->guard('admin')->user();
        
        $lastMessageTime='';
        if (!in_array($user->role, ['super_admin', 'admin'])) {
            abort(403, 'Unauthorized');
        }
        $chats = UserChat::with(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->get();
        
        $conversations = $chats->map(function ($chat) {
            $lastMessage = $chat->messages->last();
            
            $visitorId = $chat->visitor_id;
            
            // Get first message to determine if it's a user or AI message
            $firstMessage = $chat->messages->first();
            $isUser = $firstMessage && $firstMessage->sender === 'user';

            // Generate initials from visitor ID (first two characters)
            $initials = strtoupper(substr($visitorId, 0, 2));

            // Extract email and phone from messages
            $email = null;
            $phone = null;
            foreach ($chat->messages as $message) {
                if ($message->sender === 'user') {
                    // Try to find email
                    if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $message->message, $emailMatches)) {
                        $email = $emailMatches[0];
                    }
                    // Try to find phone number
                    if (preg_match('/(\+\d{1,3}[-.]?)?\d{3}[-.]?\d{3}[-.]?\d{4}/', $message->message, $phoneMatches)) {
                        $phone = $phoneMatches[0];
                    }
                }
            }

            // Check if last message is within 10 minutes
            $status = 'inactive';
            if ($lastMessage) {
                $lastMessageTime = $lastMessage->created_at->setTimezone('Asia/Kolkata');
                $currentTime = now()->setTimezone('Asia/Kolkata');
                // echo $lastMessageTime;
                $timeDifference = $currentTime->diffInMinutes($lastMessageTime);
                $status = $timeDifference <= 10 ? 'active' : 'inactive';
            }

            return [
                'user' => 'Visitor ' . substr($visitorId, 0, 8),
                'email' => $email ?? $visitorId . '@visitor.com',
                'phone' => $phone,
                'last_message' => $lastMessage ? $lastMessage->message : 'No messages yet',
                'time' => $lastMessage ? $lastMessage->created_at->setTimezone('Asia/Kolkata')->format('h:i A') : 'N/A',
                'status' => $status,
                'avatar' => $initials,
                'visitor_id' => $visitorId
            ];
        });

        // Format messages for JavaScript
        $formattedMessages = $chats->mapWithKeys(function ($chat) {
            $visitorName = 'Visitor ' . substr($chat->visitor_id, 0, 8);
            $messages = $chat->messages->map(function ($message) {
                return [
                    'type' => $message->sender,
                    'message' => $message->message,
                    'time' => $message->created_at->setTimezone('Asia/Kolkata')->format('h:i A'),
                    'date' => $message->created_at->setTimezone('Asia/Kolkata')->format('d M Y')
                ];
            });
            return [$visitorName => $messages];
        });

        return view('admin.user-chat-whit-AI', [
            'conversations' => $conversations,
            'messages' => $formattedMessages,
            'lastMessage'=> $lastMessageTime,
        ]);
    }

    public function getChatMessages($visitor_id)
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        $chat = UserChat::where('visitor_id', $visitor_id)
            ->with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->first();

        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }

        $messages = $chat->messages->map(function ($message) {
            return [
                'id' => $message->id,
                'sender' => $message->sender,
                'message' => $message->message,
                'time' => $message->created_at->format('h:i A'),
                'date' => $message->created_at->format('M d, Y'),
                'is_user' => $message->sender === 'user'
            ];
        });

        return response()->json([
            'visitor_id' => $visitor_id,
            'messages' => $messages
        ]);
    }
}