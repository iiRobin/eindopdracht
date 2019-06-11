<?php

namespace App;

use Auth;
use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'header_image',
        'residence', 'workplace', 'school', 'birthplace', 'relationship'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all the users messages.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get all friend requests
     */
    public function requests()
    {
        return $this->hasMany(Friendship::class, 'user_requested')->where('status', 'requested');
    }

    /**
     * Check if the user has send a friend request
     */
    public function isRequested($user_id)
    {
        return $this->requests->contains('requester', $user_id);
    }

    /**
     * Get all friends
     */
    public function friends()
    {
        return $this->hasMany(Friendship::class, 'requester')->where('status', 'accepted');
    }

    /**
     * Check if the user is friends
     */
    public function isFriend($user_id)
    {
        return $this->friends->contains('user_requested', $user_id);
    }

    /**
     * Get all posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Return the user's liked posts.
     */
    public function liked()
    {
        return $this->belongsToMany(Post::class, 'liked')->withPivot('id');
    }
}
