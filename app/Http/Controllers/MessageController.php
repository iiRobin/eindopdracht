<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Message;
use App\Events\MessageSent;
use App\Events\PrivateMessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
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
     * Fetch all messages.
     *
     * @return Collection
     */
    public function fetchMessages()
    {
      return Message::with('user')->get();
    }

    /**
     * Send a group chat message.
     * @param Request data.
     * @return Response
     */
    public function sendMessage(Request $request)
    {
      $message = auth()->user()->message()->create(['message' => $request->message]);

      broadcast(new MessageSent(auth()->user(), $message->load('user')))->toOthers();

      return response(['status' => 'Message sent successfully']);
    }

    /**
     * Get all private messages.
     * @param User $user
     * @return Message instance
     */
    public function privateMessages(User $user)
    {
        $privateCommunication = Message::with('user')
                                    ->where(['user_id' => Auth::id(), 'receiver_id' => $user->id])
                                    ->orWhere(function($query) use($user) {
                                      $query->where(['user_id' => $user->id, 'receiver_id' => Auth::id()]);
                                    })->get();

        return $privateCommunication;
    }

    /**
     * Send a private message.
     * @param Request data, User $user
     * @return Response
     */
    public function sendPrivateMessages(Request $request, User $user)
    {
        // Create variables
        $input = $request->all();
        $input['receiver_id'] = $user->id;
        $message = auth()->user()->messages()->create($input);

        // Broadcast to screen
        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status' => 'Private message sent successfully', 'message' => $message]);
    }
}
