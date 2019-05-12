<?php

namespace App\Traits;

use App\Friendship;
use App\User;
use Auth;

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
                                  ->where('requester', Auth::id())
                                  ->where('status', 'accepted')
                                  ->delete();

        if($friendship)
        {
           Friendship::where('user_requested', Auth::id())
                        ->where('requester', $user_id)
                        ->where('status', 'accepted')
                        ->delete();

           return $friendship;
        }

        return 'failed';
    }

    public function acceptFriend($user_id)
    {
        $friendship = Friendship::where('requester', $user_id)
                                  ->where('user_requested', Auth::id())
                                  ->where('status', 'requested')
                                  ->update(['status' => 'accepted']);

        if($friendship)
        {
            Friendship::create([
              'requester' => Auth::id(),
              'user_requested' => $user_id,
              'status' => 'accepted'
            ]);

            return $friendship;
        }

        return 'failed';
    }
}
