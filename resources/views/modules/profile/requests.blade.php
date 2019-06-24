@extends('layouts.app')

@section('title', 'Friend requests')

@section('main')
<div class="uk-container">
  @include('modules.profile.partials.header')
  <div class="uk-grid-match" uk-grid>
    @include('modules.profile.sections.infoCard')
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
                <div class="uk-width-1-3 uk-margin-small-bottom request-{{ $user->id }} request">
                  <a class="uk-link-text" href="{{ route('profile.index', ['user' => $user->id]) }}">
                    <div class="uk-width-auto">
                      <img class="uk-border-circle" width="100" height="100" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
                    </div>
                    <h5 style="margin-top:0;">{{ $user->name }}</h5>
                  </a>
                  <a href="" class="uk-icon-link accept-btn" data-user="{{ $user->id }}" uk-icon="icon: check"></a>
                  <a href="" class="uk-icon-link decline-btn" data-user="{{ $user->id }}" uk-icon="icon: close"></a>
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
  <script src="/js/acceptFriend.js"></script>
  <script src="/js/declineFriend.js"></script>
@endsection
