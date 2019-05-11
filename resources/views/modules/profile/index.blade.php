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
            <p>{{ $user->name }}</p>
          </div>
          <nav class="uk-navbar-container subnav" uk-navbar>
            <div class="uk-navbar-right">

              <ul class="uk-navbar-nav subnav-items">
                <li {{ $user->id == Auth::id() ? 'hidden' : null }}>
                  <a href="#" class="add-btn">
                    <i style="font-size: 15px;" class="fas fa-user-plus"></i>&nbsp; Add friend
                  </a>
                </li>
              </ul>

            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div uk-grid>
    <div class="uk-card uk-card-default uk-card-hover uk-width-1-3 sidebar">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
          <h3 class="uk-card-title"><span uk-icon="icon: world"></span> About</h3>
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
@endsection

@section('scripts.footer')

@endsection
