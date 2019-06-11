<div class="uk-width-1-3@m">
  <div class="uk-card uk-card-default uk-card-hover">
    <div class="uk-card-header" style="padding-right:15px!important">
      <div class="uk-grid-small uk-flex-middle" uk-grid>
        <h3 class="uk-card-title">
          <span style="font-size:30px;" uk-icon="icon: users"></span> Friends
        </h3>
      </div>
    </div>
    <div class="uk-card-body" uk-grid style="padding: 20px 35px;">
      @if(count($user->friends) > 0)
        @foreach($user->friends->take(6) as $friend)
        @php
          $user = App\User::where('id', $friend->user_requested)->first();
        @endphp
        <div class="uk-width-1-2 uk-margin-small-bottom uk-text-center">
          <a class="uk-link-text" href="{{ route('profile.index', ['user' => $user->id]) }}">
            <div class="uk-width-auto">
              <img class="uk-border-circle" width="250" height="250" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
            </div>
            <h5 class="mt-0 mb-0">{{ $user->name }}</h5>
          </a>
        </div>
        @endforeach
        <p>
          <a>See all friends</a>
        </p>
      @else
        <p>{{ $user->name }} doesn't have any friends yet. Be the first!</p>
      @endif
    </div>
  </div>
</div>
