@extends('layouts.app')

@section('main')
<div class="uk-container">
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
            <p>{{ Auth::user()->name }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="uk-grid-match" uk-grid>
      <div class="uk-width-1-3">
        <div class="uk-card uk-card-default uk-card-hover sidebar">
          <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
              <h3 class="uk-card-title"><span style="font-size:30px;" uk-icon="icon: world"></span> About</h3>
            </div>
          </div>
          <div class="uk-card-body info">
            <p><i class="fas fa-home"></i> Current residence</p>
            <p><i class="fas fa-briefcase"></i> Workplace</p>
            <p><i class="fas fa-graduation-cap"></i> School</p>
            <p><i class="fas fa-map-marker-alt"></i> Birthplace</p>
            <p><i class="fas fa-heart"></i> Relationship</p>
          </div>
        </div>
      </div>
      <div class="uk-width-2-3">
        <div style="padding:0;" class="uk-card uk-card-default uk-card-hover uk-card-body">
          <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
              <h3 class="uk-card-title"><span style="font-size:30px;" uk-icon="icon: users"></span> Friends</h3>
              <span class="uk-position-right mt-4">
                You have {{ count(Auth::user()->friends) > 1 ? count(Auth::user()->friends) . ' friends' : count(Auth::user()->friends) . ' friend'  }}
              </span>
            </div>
          </div>
          <div class="uk-card-body">
            <div class="uk-text-center uk-grid-small uk-flex-middle" uk-grid>
              @if(count(Auth::user()->friends) > 0)
                @foreach(Auth::user()->friends as $friend)
                  @php
                    $user = App\User::where('id', $friend->user_requested)->first();
                  @endphp
                  <div class="uk-width-1-3 uk-margin-small-bottom">
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
</div>
@endsection
