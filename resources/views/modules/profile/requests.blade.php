@extends('layouts.app')

@section('main')
<div class="uk-container">
  @include('modules.profile.partials.header')
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
              <h3 class="uk-card-title"><i class="fas fa-user-plus"></i> Friend requests</h3>
            </div>
          </div>
          <div class="uk-card-body">
            <div class="uk-text-center uk-grid-small uk-flex-middle requests" uk-grid>
              @if(count(Auth::user()->requests) > 0)
                @foreach(Auth::user()->requests as $key => $request)
                  @php
                    $user = App\User::where('id', $request->requester)->first();
                  @endphp
                  <div class="uk-width-1-3 uk-margin-small-bottom request-{{ $user->id }}">
                    <a class="uk-link-text" href="{{ route('profile.index', ['user' => $user->id]) }}">
                      <div class="uk-width-auto">
                        <img class="uk-border-circle" width="100" height="100" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
                      </div>
                      <h5 style="margin-top:0;">{{ $user->name }}</h5>
                    </a>
                    <a href=""
                       class="uk-button uk-button-primary accept-btn"
                       data-user="{{ $user->id }}">Accept</a>
                  </div>
                @endforeach
              @else
                <p>You don't have any friendrequests...</p>
              @endif
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts.footer')
  <script src="/js/acceptFriend.js"></script>
@endsection
