<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['chat_id', 'sender', 'message'];

    public function chat()
    {
        return $this->belongsTo(UserChat::class);
    }
}