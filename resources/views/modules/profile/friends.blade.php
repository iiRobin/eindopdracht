@extends('layouts.app')

@section('title', 'Friends')

@section('main')
<div class="uk-container">
  @include('modules.profile.partials.header')
  <div class="uk-grid-match" uk-grid>
    @include('modules.profile.sections.infoCard')
    <div class="uk-width-2-3">
      <div style="padding:0;" class="uk-card uk-card-default uk-card-hover uk-card-body">
        <div class="uk-card-header">
          <div class="uk-grid-small uk-flex-middle" uk-grid>
            <h3 class="uk-card-title"><i class="fas fa-user-friends"></i> Friends</h3>
            <span class="uk-position-right mt-4">
              You have
              <span class="friendcount">
                {{ count(Auth::user()->friends) == 1 ? count(Auth::user()->friends) . ' friend' : count(Auth::user()->friends) . ' friends'  }}
              </span>
            </span>
          </div>
        </div>
        <div class="uk-card-body">
          <div class="uk-text-center uk-grid-small uk-flex-middle friends" uk-grid>
            @if(count(Auth::user()->friends) > 0)
              @foreach(Auth::user()->friends as $friend)
                @php
                  $user = App\User::where('id', $friend->user_requested)->first();
                @endphp
                <div class="uk-width-1-3 uk-margin-small-bottom friend-{{ $user->id }} unfriend">
                  <a href="" style="margin-left:87px;" class="uk-icon-link remove-btn" data-user="{{ $user->id }}" uk-icon="icon: close"></a>
                  <a class="uk-link-text" href="{{ route('profile.index', ['user' => $user->id]) }}">
                    <div class="uk-width-auto">
                      <img class="uk-border-circle" width="100" height="100" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
                    </div>
                    <h5 class="mt-0 mb-0">{{ $user->name }}</h5>
                    <span>
                      {{ count($user->friends) > 1 ? count($user->friends) . ' friends' : count($user->friends) . ' friend'  }}
                    </span>
                  </a>
                </div>
              @endforeach
            @else
              <p>You don't have any friends... :(</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="editModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical" style="border:2px solid black;border-radius: 5%;">
      <h2 class="uk-modal-title">Edit your profile</h2>
      <form action="{{ route('profile.edit') }}" method="post">
        {{ csrf_field() }}
        <div class="uk-flex-center editProfile" uk-grid>
          <div class="uk-width-1-3 uk-grid-item-match">
            <i class="fas fa-home"></i>
            <i class="fas fa-briefcase"></i>
            <i class="fas fa-graduation-cap"></i>
            <i class="fas fa-map-marker-alt"></i>
            <i class="fas fa-heart"></i>
          </div>
          <div class="uk-width-1-3">
            <p> Current residence</p>
            <p> Workplace</p>
            <p> School</p>
            <p> Birthplace</p>
            <p> Relationship</p>
          </div>
          <div class="uk-width-1-3 inputs">
            <input type="text" name="residence" value="{{ Auth::user()->residence }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="workplace" value="{{ Auth::user()->workplace }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="school" value="{{ Auth::user()->school }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="birthplace" value="{{ Auth::user()->birthplace }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="relationship" value="{{ Auth::user()->relationship }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
          </div>
        </div>
        <p class="uk-text-right">
          <input class="uk-button uk-button-primary" type="submit" value="Submit" />
          <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts.footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {

      $('.unfriend').on('click', 'a.remove-btn', function(e){
        e.preventDefault();

        // Prepare data.
        var user = $(this).data('user'),
          data = { id: user },
          toggle = $(this);

        // Send request through ajax.
        $.ajax({
          type: 'post',
          url: '/profile/'+user+'/remove',
          data: data,
          dataType: "json",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data){
            // Remove 1 from friends counter.
    				var friends = $('.badge-friends').text();
    				$('.badge-friends').text((parseInt(friends) - 1));

            var friendcount = $('.friendcount').text();
            friendcount = friendcount.trim().substr(0, 1);
            friendcount = parseInt(friendcount) - 1

            if(parseInt(friendcount) == 1) {
              $('.friendcount').text('1 friend');
            } else {
              $('.friendcount').text(friendcount + ' friends');
            }

    				// Remove the user from the screen.
    				$('.friend-' + user).remove();

    				// Append message when no friendrequests
    				if(parseInt(friends) == 1) {
    					$('.friends').append('<p>You don\'t have any friends... :(</p>');
    				}
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        });
      });

    });
  </script>
@endsection
