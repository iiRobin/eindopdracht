<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
