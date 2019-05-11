<?php

namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable
{
    public function addFriend($user_id)
    {
        $friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_id,
            'status' => 'requested'
        ]);

        if($friendship)
          return $friendship;

        return 'failed';
    }

    public function deleteFriend($user_id)
    {
        $friendship = Friendship::where('user_requested', $user_id)
                                  ->where('status', 'accepted')
                                  ->delete();

        if($friendship)
          return $friendship;

        return 'failed';
    }
}
