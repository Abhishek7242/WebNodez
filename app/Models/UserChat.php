<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
    protected $fillable = ['visitor_id'];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
