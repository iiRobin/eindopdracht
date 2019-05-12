<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show profile view.
     *
     * @return \Illuminate\Http\Response.
     */
    public function showProfile(User $user)
    {
        return view('modules.profile.index', compact('user'));
    }

    /**
     * Show friend requests view.
     *
     * @return \Illuminate\Http\Response.
     */
    public function showRequests()
    {
        return view('modules.profile.requests');
    }

    /**
     * Show users friends view.
     *
     * @return \Illuminate\Http\Response.
     */
    public function showFriends()
    {
        return view('modules.profile.friends');
    }

    /**
     * Send a friend request.
     *
     * @return \Illuminate\Http\Response.
     */
    public function sendFriendRequest(User $user)
    {
        return Auth::user()->addFriend($user->id);
    }

    /**
     * Remove a user from your friends.
     *
     * @return \Illuminate\Http\Response.
     */
    public function removeFriend(User $user)
    {
        return Auth::user()->deleteFriend($user->id);
    }

    /**
     * Accept a user's friendrequest.
     *
     * @return \Illuminate\Http\Response.
     */
    public function acceptFriendRequest(User $user)
    {
        return Auth::user()->acceptFriend($user->id);
    }


}
