<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show profile view.
     * @param User $user, current user.
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
        $user = Auth::user();
        return view('modules.profile.requests', compact('user'));
    }

    /**
     * Show users friends view.
     *
     * @return \Illuminate\Http\Response.
     */
    public function showFriends()
    {
        $user = Auth::user();
        return view('modules.profile.friends', compact('user'));
    }

    /**
     * Update the users profile.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function update(Request $request)
    {
      // Get the user
      $user = Auth::user();

      // Update the user.
      $user->update([
        'residence' => $request->residence,
        'workplace' => $request->workplace,
        'school' => $request->school,
        'birthplace' => $request->birthplace,
        'relationship' => $request->relationship
      ]);

      setMessage("Your profile has been updated", "success");
      return redirect()->back();
    }

    /**
     * Upload header image.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function uploadHeader(Request $request)
    {
      // Get the user
      $user = Auth::user();

      if($request->hasFile('header'))
      {
        // Store image
        $filenameImage = $request->header->getClientOriginalName();
        $request->header->storeAs('public/headers', $filenameImage);

        // Update the user.
        $user->update([
          'header_image' => 'headers/'.$filenameImage
        ]);
      }

      setMessage("Header image has successfully been uploaded.", "success");
      return redirect()->back();
    }

    /**
     * Upload profile picture.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function uploadImage(Request $request)
    {
      // Get the user
      $user = Auth::user();

      if($request->hasFile('image'))
      {
        // Store image
        $filenameImage = $request->image->getClientOriginalName();
        $request->image->storeAs('public/users', $filenameImage);

        // Update the user.
        $user->update([
          'avatar' => 'users/'.$filenameImage
        ]);
      }

      setMessage("Profile picture has successfully been uploaded.", "success");
      return redirect()->back();
    }

    /**
     * Delete header image.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function deleteHeader(User $user)
    {
      // Update the user.
      $user->update([
        'header_image' => 'headers/default.jpg'
      ]);

      setMessage("Image has successfully been removed.", "success");
      return redirect()->back();
    }


}
