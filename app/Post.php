<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content', 'picture', 'likes'
    ];

    /**
     * Get the user from the post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments from the post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The liked posts.
     */
    public function liked()
    {
        return $this->belongsToMany('App\User', 'liked');
    }

    /**
     * Check if the current post is liked.
     *
     * @param  Integer  $user_id  Id of the selected user.
     */
    public function isLiked($user_id)
    {
        return $this->liked->contains($user_id);
    }
}
