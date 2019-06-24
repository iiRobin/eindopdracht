<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\Liked;
use App\Comment;
use App\Post;

class PostController extends Controller
{
    /**
     * Make a post.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function create(Request $request)
    {
        Post::create([
          'user_id' => $request->user_id,
          'content' => $request->content
        ]);

        setMessage("Post successfully created", "success");
        return redirect()->back();
    }

    /**
     * Make a comment on a post.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function createComment(Request $request)
    {
        Comment::create([
          'user_id' => $request->user_id,
          'post_id' => $request->post_id,
          'content' => $request->content
        ]);

        setMessage("Comment successfully posted", "success");
        return redirect()->back();
    }

    /**
     * Delete a comment.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function deleteComment(Comment $comment)
    {
        // Delete the comment
        $comment->delete();

        setMessage("Comment successfully deleted", "success");
        return redirect()->back();
    }

    /**
     * Delete a post.
     * @param Request $request, Form data
     * @return \Illuminate\Http\Response.
     */
    public function deletePost(Post $post)
    {
        // Delete the post
        $post->delete();

        setMessage("Post successfully deleted", "success");
        return redirect()->back();
    }

    /**
     * Toggle the liked state of the selected post.
     *
     * @param   Request  $request  Form request via ajax.
     * @return  Json encoded status result.
     */
    public function toggleLiked(Request $request)
    {
      // Get post id.
      $post = $request->id;

      // Toggle liked state.
      $status = (new Liked($post))->toggle();

      // Return json encoded result.
      return \Response::json($status);
    }

    /**
     * Remove the liked state of the selected post.
     *
     * @param   Request  $request  Form request via ajax.
     * @return  Json encoded status result.
     */
    public function removeLiked(Request $request)
    {
      // Get post id.
      $post = $request->id;

      // Remove liked state.
      $status = (new Liked($post))->remove();

      // Return json encoded result.
      return \Response::json($status);
    }
}
