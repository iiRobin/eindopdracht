<div uk-grid>
  <div class="uk-width-1-1">
    <div class="uk-background-cover uk-padding uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
         style="background-image: url({{ $user->header_image ? asset('storage') .'/'. $user->header_image : asset('storage') .'/headers/default.jpg' }})">
      @if($user->id == Auth::id())
        <div class="uk-position-top-left">
          <div class="add-background-img">
            <a href="#" class="uk-icon-link" uk-icon="icon: image"></a>
          </div>
          <div class="editDropdown" uk-dropdown="mode: click; pos: bottom-left">
            <ul class="uk-list uk-link-text">
              <li>
                <a href="#" class="openFile" onclick="$('input[type=file]').trigger('click');">Upload image</a>
                <form action="{{ route('profile.upload') }}" method="post" style="display:none;" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" onchange="this.form.submit()"/>
                </form>
              </li>
              @if($user->header_image)
                <li>
                  <a href="#">Delete image</a>
                </li>
              @endif
            </ul>
          </div>
        </div>
      @endif
      <div class="uk-position-bottom-right header">
        <div class="uk-position-left">
          <img class="avatar" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
        </div>
        <div class="uk-position-left display-name">
          <p><a class="uk-link-heading" href="{{ route('profile.index', ['user' => $user->id]) }}">{{ $user->name }}</a></p>
        </div>
        @auth
          @include('modules.profile.partials.subnav')
        @endauth
      </div>
    </div>
  </div>
</div>
