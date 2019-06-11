<div id="confirmModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Add friend</h2>
    </div>
    @if($user->isRequested(Auth::id()))
      <p>You already send {{ $user->name }} a friendrequest.</p>
      <p class="uk-text-right add-friend">
        <button class="uk-button uk-button-default uk-modal-close" type="button">OK</button>
      </p>
    @else
      <p>Do you want to add {{ $user->name }} to your friend list?</p>
      <p class="uk-text-right add-friend">
        <button class="uk-button uk-button-primary add-btn" type="button" data-user="{{ $user->id }}">Add friend</button>
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
      </p>
    @endif
  </div>
</div>
<div id="blockModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Block all communication</h2>
    </div>
    <p>You are about to block all communication with {{ $user->name }}.</p>
    <p class="uk-text-right block-person">
      <button class="uk-button uk-button-primary block-btn" type="button" data-user="{{ $user->id }}">Yes, block them</button>
      <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
    </p>
  </div>
</div>
<div id="removeModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Remove friend</h2>
    </div>
    <p>Are you sure you want to remove {{ $user->name }} from your friend list?</p>
    <p class="uk-text-right unfriend">
      <button class="uk-button uk-button-primary remove-btn" type="button" data-user="{{ $user->id }}">Remove friend</button>
      <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
    </p>
  </div>
</div>
@if(Auth::id() == $user->id)
  <div id="editModal" class="uk-flex-top" style="z-index:99999;" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical" style="border:2px solid black;border-radius: 5%;">
      <div class="uk-modal-header uk-margin-medium-bottom">
        <h2 class="uk-modal-title">Edit your profile</h2>
      </div>
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
            <input type="text" name="residence" value="{{ $user->residence }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="workplace" value="{{ $user->workplace }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="school" value="{{ $user->school }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="birthplace" value="{{ $user->birthplace }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
            <input type="text" name="relationship" value="{{ $user->relationship }}" class="uk-input uk-form-width-small uk-margin-small-bottom"/>
          </div>
        </div>
        <p class="uk-text-right">
          <input class="uk-button uk-button-primary" type="submit" value="Save" />
          <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        </p>
      </form>
    </div>
  </div>
@endif
