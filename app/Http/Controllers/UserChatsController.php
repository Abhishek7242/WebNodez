<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Events\TakeControlEvent;
use App\Events\AdminMessageEvent;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

class UserChatsController extends Controller
{
    //

    public function updateUserActive(Request $request)
    {
        try {
            $request->validate([
                'visitor_id' => 'required|uuid'
            ]);

            $chat = UserChat::where('visitor_id', $request->visitor_id)->first();

            if (!$chat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chat not found'
                ], 404);
            }

            // Update the created_at timestamp to current time
            $chat->updated_at = now();
            $chat->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Chat timestamp updated successfully',
                'updated_at' => $chat->created_at->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            Log::error('Update user active error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update chat timestamp',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getLastActiveTime(Request $request, $visitor_id)
    {
        try {

            $chat = UserChat::where('visitor_id', $visitor_id)->first();

            if (!$chat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chat not found'
                ], 404);
            }

            // Update the created_at timestamp to current time

            return response()->json([
                'status' => 'success',
                'message' => 'Chat timestamp updated successfully',
                'updated_at' => $chat->created_at->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            Log::error('Update user active error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update chat timestamp',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function storeMessage(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|uuid',
            'sender' => 'required',
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
        if($user->status === 'blocked') {
            session()->forget('super_admin_logged_in');
            auth()->guard('admin')->logout();
            return redirect()->route('admin.unauthorized')->with('error', 'You are blocked.');
        }

        $lastMessageTime = '';
        if (!in_array($user->role, ['super_admin', 'admin','god_admin'])) {
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

            // Generate username and avatar from email
            $username = 'Visitor ' . substr($visitorId, 0, 8);
            $avatar = strtoupper(substr($visitorId, 0, 2));

            if ($email) {
                // Extract name from email (part before @)
                $emailParts = explode('@', $email);
                $namePart = $emailParts[0];

                // Convert to proper case and replace special characters
                $namePart = str_replace(['.', '_', '-'], ' ', $namePart);
                $namePart = ucwords($namePart);

                // Use first two words if name is long
                $nameWords = explode(' ', $namePart);
                $displayName = implode(' ', array_slice($nameWords, 0, 2));

                // Generate initials for avatar
                $initials = '';
                foreach ($nameWords as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                }
                $initials = substr($initials, 0, 2);

                $username = $displayName;
                $avatar = $initials;
            }

            // Check if chat was updated within 1 minute
            $status = 'inactive';
            $chatUpdatedTime = $chat->updated_at->setTimezone('Asia/Kolkata');
            $currentTime = now()->setTimezone('Asia/Kolkata');
            $timeDifference = $currentTime->diffInMinutes($chatUpdatedTime);
            $status = $timeDifference <= 2 ? 'active' : 'inactive';

            // Format the time based on how old it is
            $timeStr = $chatUpdatedTime->format('h:i A');
            $formattedTime = '';

            if ($chatUpdatedTime->isToday()) {
                $formattedTime = $timeStr;
            } elseif ($chatUpdatedTime->isYesterday()) {
                $formattedTime = 'Yesterday ' . $timeStr;
            } else {
                $diffDays = $currentTime->diffInDays($chatUpdatedTime);
                $diffYears = $currentTime->diffInYears($chatUpdatedTime);

                if ($diffYears > 0) {
                    $formattedTime = $diffYears . ' ' . ($diffYears === 1 ? 'year' : 'years') . ' ago ' . $timeStr;
                } else {
                    $formattedTime = $diffDays . ' ' . ($diffDays === 1 ? 'day' : 'days') . ' ago ' . $timeStr;
                }
            }

            return [
                'user' => $username,
                'email' => $email ?? $visitorId . '@visitor.com',
                'phone' => $phone,
                'last_message' => $lastMessage ? $lastMessage->message : 'No messages yet',
                'time' => $formattedTime,
                'status' => $status,
                'avatar' => $avatar,
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
        $conversations = $conversations->reverse();

        return view('admin.user-chat-with-AI', [
            'conversations' => $conversations,
            'messages' => $formattedMessages,
            'lastMessage' => $lastMessageTime,
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

        // Calculate days until deletion
        $createdAt = Carbon::parse($chat->created_at);
        $daysUntilDeletion = 90 - $createdAt->diffInDays(now());
        $isExpiringSoon = $daysUntilDeletion <= 7;

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
            'messages' => $messages,
            'days_until_deletion' => $daysUntilDeletion,
            'is_expiring_soon' => $isExpiringSoon
        ]);
    }

    public function broadcast(Request $request)
    {
        $message = $request->input('message');
        $sender = $request->input('sender');
        $visitor_id = $request->input('visitor_id');

        event(new NewChatMessage($message, $sender, $visitor_id));

        return response()->json(['status' => 'success']);
    }
    public function takeControl(Request $request)
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin','god_admin', 'contact_support'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $request->validate([
                'admin_control' => 'required|boolean',
                'visitor_id' => 'required|uuid'
            ]);

            $admin_control = $request->input('admin_control');
            $visitor_id = $request->input('visitor_id');

            // Verify the chat exists
            $chat = UserChat::where('visitor_id', $visitor_id)->first();
            if (!$chat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chat not found'
                ], 404);
            }

            Log::info('Take control:', [
                'admin_control' => $admin_control,
                'visitor_id' => $visitor_id
            ]);

            broadcast(new TakeControlEvent($admin_control, $visitor_id))->toOthers();

            Log::info('Take control successfully');

            return response()->json([
                'status' => 'Control broadcasted successfully',
                'admin_control' => $admin_control,
                'visitor_id' => $visitor_id
            ]);
        } catch (\Exception $e) {
            Log::error('Broadcast error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to broadcast control',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendAdminMessage(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin', 'contact_support'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $request->validate([
                'message' => 'required|string',
                'visitor_id' => 'required|uuid',
                'admin_name' => 'required|string'
            ]);

            $message = $request->input('message');
            $visitor_id = $request->input('visitor_id');
            $admin_name = $request->input('admin_name');

            Log::info('Broadcasting admin message:', [
                'message' => $message,
                'admin_name' => $admin_name,
                'visitor_id' => $visitor_id
            ]);

            // Broadcast the message
            broadcast(new AdminMessageEvent($message, $visitor_id, $admin_name))->toOthers();

            return response()->json([
                'status' => 'success',
                'message' => 'Message sent successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Admin message error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteChat($visitor_id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','god_admin'])) {
            abort(403, 'Unauthorized');
        }

        try {
            $chat = UserChat::where('visitor_id', $visitor_id)->first();

            if (!$chat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chat not found'
                ], 404);
            }

            // Delete all messages associated with this chat
            $chat->messages()->delete();

            // Delete the chat itself
            $chat->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Chat deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Delete chat error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete chat',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}