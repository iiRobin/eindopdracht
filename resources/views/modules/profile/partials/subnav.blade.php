<nav class="uk-navbar-container subnav" uk-navbar>
  <div class="uk-navbar-right">

    <ul class="uk-navbar-nav subnav-items">
      @if($user->id !== Auth::id())
        <li class="friend">
          @if(!$user->isRequested(Auth::id()))
            <a href=""
               class="{{ (Auth::user()->isFriend($user->id)) ? 'remove-btn' : 'add-btn' }}"
               data-user="{{ $user->id }}"
               uk-tooltip="{{ (Auth::user()->isFriend($user->id)) ? 'Remove friend' : 'Add friend' }}">
              <i style="font-size:15px;" class="{{ (Auth::user()->isFriend($user->id)) ? 'fas fa-user-minus' : 'fas fa-user-plus' }}"></i>&nbsp; {{ (Auth::user()->isFriend($user->id)) ? 'Remove friend' : 'Add friend' }}
            </a>
          @else
            <p style="font-size:18px;">You already sent this user a friendrequest!</p>
          @endif
        </li>
      @else
        <li>
          <a href="{{ route('profile.requests') }}" class="requests-btn uk-button uk-button-secondary">
            Friendrequests &nbsp;<span class="badge uk-badge">{{ count(Auth::user()->requests) }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('profile.friends') }}" class="friends-btn uk-button uk-button-secondary">
            Friends &nbsp;<span class="badge uk-badge">{{ count(Auth::user()->friends) }}</span>
          </a>
        </li>
      @endif
    </ul>

  </div>
</nav>
