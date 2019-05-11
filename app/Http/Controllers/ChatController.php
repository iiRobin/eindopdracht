<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Show group chat view.
     *
     * @return \Illuminate\Http\Response.
     */
    public function showGroup()
    {
      return view('group');
    }

    /**
     * Show private chat view.
     *
     * @return \Illuminate\Http\Response.
     */
    public function showPrivate()
    {
      return view('private');
    }

    /**
     * Get all users.
     *
     * @return collection.
     */
    public function getUsers()
    {
      return User::all();
    }
}
