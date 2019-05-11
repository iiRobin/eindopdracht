<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
      'image', 'message',
      'user_id', 'receiver_id'
    ];

    /**
     * Get the user that send the message.
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
