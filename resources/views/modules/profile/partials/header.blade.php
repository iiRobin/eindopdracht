<div uk-grid>
  <div class="uk-width-1-1">
    <div class="uk-background-cover uk-padding uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url('https://newevolutiondesigns.com/images/freebies/city-wallpaper-32.jpg')">
      <div class="uk-position-top-left add-background-img">
        <i class="fas fa-image"></i>
      </div>
      <div class="uk-position-bottom-right header">
        <div class="uk-position-left">
          <img class="avatar" src="{{ asset('storage') .'/'. Auth::user()->avatar }}" alt="{{ Auth::user()->name }}'s avatar">
        </div>
        <div class="uk-position-left display-name">
          <p><a class="uk-link-heading" href="{{ route('profile.index', ['user' => Auth::id()]) }}">{{ Auth::user()->name }}</a></p>
        </div>
        <nav class="uk-navbar-container subnav" uk-navbar>
          <div class="uk-navbar-right">

            <ul class="uk-navbar-nav subnav-items">
              <li>
                <a href="{{ route('profile.requests') }}" class="requests-btn uk-button uk-button-secondary {{ str_is(Request::segment(2), 'requests') ? 'uk-active' :  null }}">
                  Friendrequests &nbsp;<span class="badge uk-badge">{{ count(Auth::user()->requests) }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('profile.friends') }}" class="friends-btn uk-button uk-button-secondary {{ str_is(Request::segment(2), 'friends') ? 'uk-active' :  null }}">
                  Friends &nbsp;<span class="badge uk-badge">{{ count(Auth::user()->friends) }}</span>
                </a>
              </li>
            </ul>

          </div>
        </nav>
      </div>
    </div>
  </div>
</div>
