<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class FriendController extends Controller
{
    /**
     * Send a friend request.
     * @param User $user, current user.
     * @return \Illuminate\Http\Response.
     */
    public function sendFriendRequest(User $user)
    {
        setMessage("Friend invite send to ". $user->name, "success");
        return Auth::user()->addFriend($user->id);
    }

    /**
     * Remove a user from your friends.
     * @param User $user, current user.
     * @return \Illuminate\Http\Response.
     */
    public function removeFriend(User $user)
    {
        setMessage($user->name. " has been removed from your friend list.", "success");
        return Auth::user()->deleteFriend($user->id);
    }

    /**
     * Accept a user's friendrequest.
     * @param User $user, current user.
     * @return \Illuminate\Http\Response.
     */
    public function acceptFriendRequest(User $user)
    {
        return Auth::user()->acceptFriend($user->id);
    }

    /**
     * Decline a user's friendrequest.
     * @param User $user, current user.
     * @return \Illuminate\Http\Response.
     */
    public function declineFriendRequest(User $user)
    {
        return Auth::user()->declineFriend($user->id);
    }
}
