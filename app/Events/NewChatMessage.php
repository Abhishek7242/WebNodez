<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $visitor_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $sender, $visitor_id)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->visitor_id = $visitor_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn():array
    {
        return [new Channel('chatbot.' . $this->visitor_id)];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs():string
    {
        return 'chatbot-message';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith():array
    {
        return [
            'message' => $this->message,
            'sender' => $this->sender,
            'visitor_id' => $this->visitor_id,
            'timestamp' => now()->toIso8601String()
        ];
    }
}