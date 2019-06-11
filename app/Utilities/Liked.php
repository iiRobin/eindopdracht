<?php

namespace App\Utilities;

use Auth;
use App\Post;

class Liked
{
	/**
	 * Selected post id.
	 * @var  $id
	 */
	protected $id;

	/**
	 * Class constructor.
	 *
	 * @param  Integer  $id  Id of the post to toggle.
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * Toggle liked state of the selected post.
	 */
	public function toggle()
	{
		// Get Post.
		$post = Post::find($this->id);

		// Check liked status.
		if($this->isLiked($post))
		{
			// Detach user from post.
			$post->liked()->detach(Auth::id());

			// Substract 1 like from the post
			$post->likes = $post->likes - 1;
			$post->save();

			return 'detached';
		}
		else
		{
			// Attach user to post.
			$post->liked()->attach(Auth::id());

			// Add 1 like to the post
			$post->likes = $post->likes + 1;
			$post->save();

			return 'attached';
		}
	}

	/**
	 * Remove liked state of the selected post.
	 */
	public function remove()
	{
		// Get video.
		$post = Post::find($this->id);

		// Detach user from post.
		$post->liked()->detach(Auth::id());
		return true;
	}

	/**
	 * Check if post is liked for the current user.
	 *
	 * @param  Post  $post  The post to check.
	 */
	private function isLiked(Post $post)
	{
		return $post->liked->contains(Auth::id());
	}

}
