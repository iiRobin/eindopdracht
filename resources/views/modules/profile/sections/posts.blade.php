<div class="uk-width-1-3@m" style="padding: 0px 0px;">
  @if(count($user->posts) > 0)
    @foreach($user->posts->sortByDesc('created_at') as $post)
      <div class="uk-card uk-card-default uk-card-hover uk-margin-small-bottom uk-visible-toggle post" tabindex="-1">
        <div class="uk-card-header">
          <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
              <img class="uk-border-circle" width="40" height="40" src="{{ asset('storage') .'/'. $post->user->avatar }}" alt="{{ $post->user->name }}'s avatar">
            </div>
            <div class="uk-width-expand">
              <h3 class="uk-card-title uk-margin-remove-bottom">
                <a class="uk-link-heading" href="{{ route('profile.index', ['user' => $post->user->id]) }}">{{ $post->user->name }}</a>
              </h3>
              <p class="uk-text-meta uk-margin-remove-top">
                <time datetime="{{ $post->created_at }}">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</time>
              </p>
            </div>
          </div>
        </div>
        @if($post->user->id == Auth::id())
          <div class="uk-position-top-right uk-position-small uk-hidden-hover">
            <a href="#removePostModal-{{ $post->id }}" class="uk-align-right" uk-icon="icon: close" uk-toggle></a>
          </div>
        @endif
        <div class="uk-card-body" uk-grid style="padding: 20px 35px;padding-bottom:0px !important">
          <div class="uk-width-expand uk-text-left">
            {{ $post->content }}
          </div>
        </div>
        @auth
          <div class="uk-card-footer" style="padding: 15px 30px;">
            <div class="uk-child-width-1-3 uk-text-center" uk-grid>
              <div class="post-btn">
                <a class="uk-link-text like-post {{ $post->isLiked(Auth::id()) ? 'liked' : '' }}"
                   uk-tooltip="title: {{ $post->isLiked(Auth::id()) ? 'Dislike' : 'Like' }}; pos: top;"
                   data-post="{{ $post->id }}"
                   href="">
                  <span uk-icon="icon: heart"></span> Like
                </a>
              </div>
              <div class="post-btn">
                <a href="#commentModal-{{ $post->id }}" class="uk-link-text" uk-toggle>
                  <span uk-icon="icon: commenting"></span> Comment
                </a>
              </div>
              <div class="post-btn">
                <a href="" class="uk-link-text">
                  <span uk-icon="icon: link"></span> Share
                </a>
              </div>
            </div>
          </div>
        @endauth
      </div>
      <div id="commentModal-{{ $post->id }}" class="uk-flex-top" style="z-index:99999;" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical" uk-overflow-auto>
          <h2 class="uk-modal-title">Comments</h2>
          @if(count($post->comments) > 0)
            @foreach($post->comments as $comment)
              <article class="uk-comment uk-visible-toggle" tabindex="-1">
                <header class="uk-comment-header uk-position-relative">
                  <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                      <img class="uk-comment-avatar" src="{{ asset('storage') .'/'. $comment->user->avatar }}" width="80" height="80" alt="">
                    </div>
                    <div class="uk-width-expand">
                      <h4 class="uk-comment-title uk-margin-remove">
                        <a class="uk-link-reset" href="{{ route('profile.index', ['user' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
                      </h4>
                      <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                        <li>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</li>
                      </ul>
                    </div>
                  </div>
                  @if($comment->user->id == Auth::id())
                    <div class="uk-position-top-right uk-position-small uk-hidden-hover">
                      <a href="#removeCommentModal" class="uk-align-right" uk-icon="icon: close" uk-toggle></a>
                    </div>
                  @endif
                </header>
                <div class="uk-comment-body">
                  <p>{{ $comment->content }}</p>
                </div>
              </article>
              @if(!$loop->last)
                <hr />
              @endif
              <div id="removeCommentModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                  <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Remove comment</h2>
                  </div>
                  <p>Are you sure you want to remove your comment?</p>
                  <p class="uk-text-right">
                    <a href="{{ route('profile.comment.delete', ['comment' => $comment->id]) }}" class="uk-button uk-button-primary">Remove comment</a>
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                  </p>
                </div>
              </div>
            @endforeach
          @else
            <p>This post doesn't have any comments yet...</p>
          @endif
          <form class="commentform uk-align-center" action="{{ route('profile.comment') }}" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <textarea name="content" class="uk-textarea"
                      placeholder="Say something about this post." style="resize:none;padding-bottom: 50px"></textarea>
            <p class="uk-text-right">
              <input class="uk-button uk-button-primary" type="submit" value="Post">
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            </p>
          </form>
        </div>
      </div>
      <div id="removePostModal-{{ $post->id }}" class="uk-flex-top" style="z-index:99999;" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
          <div class="uk-modal-header">
            <h2 class="uk-modal-title">Remove post</h2>
          </div>
          <p>Are you sure you want to remove your post?</p>
          <p class="uk-text-right">
            <a href="{{ route('profile.post.delete', ['post' => $post->id]) }}" class="uk-button uk-button-primary">Remove post</a>
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
          </p>
        </div>
      </div>
    @endforeach
  @else
    @if(!$user->id == Auth::id())
      <div class="uk-card-body" uk-grid style="padding: 20px 35px;">
        <p>{{ $user->name }} has not yet posted anything...</p>
      </div>
    @endif
  @endif
</div>
