<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id',
        'content'
    ];

    /**
     * Get the user from the comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post from the comment
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


}
