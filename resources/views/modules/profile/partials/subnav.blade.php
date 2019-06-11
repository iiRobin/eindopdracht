<nav class="uk-navbar-container subnav" uk-navbar="mode: click">
  <div class="uk-navbar-right">

    <ul class="uk-navbar-nav subnav-items">
      @if($user->id !== Auth::id())
        <li class="friend">
          @if(!Auth::user()->isFriend($user->id))
            <a href="#confirmModal" class="add-friend-btn" data-user="{{ $user->id }}" uk-toggle>
              <i style="font-size:16px;" class="fas fa-user-plus"></i>&nbsp;Add friend
            </a>
          @else
            <a href="#" data-user="{{ $user->id }}">
              Send message
            </a>
          @endif
        </li>
        <li>
          <a class="more-btn" href="#">More <span uk-icon="icon: chevron-down"></span></a>
          <div class="uk-navbar-dropdown more-nav">
            <ul class="uk-nav uk-navbar-dropdown-nav">
              <li>
                <a href="#blockModal" class="block-btn" data-user="{{ $user->id }}" uk-toggle>
                  <span uk-icon="icon: ban"></span> Block this person
                </a>
              </li>
              @if(Auth::user()->isFriend($user->id))
                <li>
                  <a href="#removeModal" class="remove-friend-btn" data-user="{{ $user->id }}" uk-toggle>
                    <i style="font-size:16px;" class="fas fa-user-minus"></i> Remove friend
                  </a>
                </li>
              @endif
            </ul>
          </div>
        </li>
      @else
        <li>
          <a href="{{ route('profile.requests') }}" class="requests-btn uk-button uk-button-secondary">
            Friend requests &nbsp;<span class="badge uk-badge badge-requests">{{ count(Auth::user()->requests) }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('profile.friends') }}" class="friends-btn uk-button uk-button-secondary">
            Friends &nbsp;<span class="badge uk-badge badge-friends">{{ count(Auth::user()->friends) }}</span>
          </a>
        </li>
      @endif
    </ul>

  </div>
</nav>
