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
            <img class="avatar" src="{{ asset('storage') .'/'. $user->avatar }}" alt="{{ $user->name }}'s avatar">
          </div>
          <div class="uk-position-left display-name">
            <p><a class="uk-link-heading" href="{{ route('profile.index', ['user' => $user->id]) }}">{{ $user->name }}</a></p>
          </div>
          @include('modules.profile.partials.subnav')
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
  </div>
  <div id="confirmModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
      <h2 class="uk-modal-title">Confirmation</h2>
      <p>Do you want to add this person to your friendlist?</p>
      <p class="uk-text-right add-friend">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        @if($user->isRequested(Auth::id()))
          <button class="uk-button">Request send!</button>
        @else
          <button class="uk-button uk-button-primary add-btn" type="button" data-user="{{ $user->id }}">Confirm</button>
        @endif
      </p>
    </div>
  </div>
  <div id="blockModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
      <h2 class="uk-modal-title">Confirmation</h2>
      <p>Are you sure you want to block this person?</p>
      <p class="uk-text-right block-friend">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        <button class="uk-button uk-button-primary block-btn" type="button" data-user="{{ $user->id }}">Confirm</button>
      </p>
    </div>
    <div id="removeModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h2 class="uk-modal-title">Confirmation</h2>
        <p>Are you sure you want to delete this person from your friendslist?</p>
        <p class="uk-text-right unfriend">
          <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
          <button class="uk-button uk-button-primary remove-btn" type="button" data-user="{{ $user->id }}">Confirm</button>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts.footer')
  <script src="/js/addFriend.js"></script>
  <script src="/js/removeFriend.js"></script>
@endsection
