@extends('layouts.app')

@section('title', $user->name)

@section('main')
<div class="uk-container">
  @include('modules.profile.partials.header')
  <div uk-grid="masonry: true" class="uk-margin-small-bottom">
    @include('modules.profile.sections.infoCard')
    @if($user->id == Auth::id())
      @include('modules.profile.sections.makePost')
      @include('modules.profile.sections.friends')
      <div class="uk-width-1-3@m"></div>
      @include('modules.profile.sections.posts')
    @else
      @include('modules.profile.sections.posts')
      @include('modules.profile.sections.friends')
    @endif
  </div>
  @auth
    @include('modules.profile.partials.modals')
  @endauth
</div>
@endsection

@section('scripts.footer')
  <script src="/js/addFriend.js"></script>
  <script src="/js/removeFriend.js"></script>
  <script src="/js/liked.js"></script>
@endsection
