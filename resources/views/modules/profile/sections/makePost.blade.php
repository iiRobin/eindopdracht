<div class="uk-width-1-3@m" style="padding: 0px 0px">
  <div class="uk-card uk-card-default uk-card-hover">
    <div class="uk-card-header" style="padding-right:15px!important">
      <div class="uk-grid-small uk-flex-middle" uk-grid>
        <h3 class="uk-card-title">
          <span style="font-size:30px;" uk-icon="icon: comment"></span> Make a post
        </h3>
      </div>
    </div>
    <div class="uk-card-body" uk-grid style="padding: 20px 20px;">
      <div class="uk-width-1-3 uk-margin-medium-bottom">
        <img class="uk-border-circle postavatar" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
      </div>
      <hr class="uk-divider-vertical" style="height:65px !important;margin-left:-6%;"/>
      <div class="uk-width-expand uk-margin-medium-bottom">
        <form class="postform" action="{{ route('profile.post') }}" method="post">
          @csrf
          <textarea name="content" class="postarea" placeholder="Tell us about your day." style="resize:none"></textarea>
          <input class="uk-button uk-button-default uk-position-bottom-right uk-margin-small-right uk-margin-small-bottom" type="submit" value="Share">
          <input type="hidden" name="user_id" value="{{ $user->id }}" />
        </form>
      </div>
      <hr class="uk-position-bottom-center" style="width:100%;margin:0px 0px 66px 0px"/>
    </div>
  </div>
</div>
