<div class="uk-width-1-3@m">
  <div class="uk-card uk-card-default uk-card-hover sidebar">
    <div class="uk-card-header" style="padding-right:15px!important">
      <div class="uk-grid-small uk-flex-middle" uk-grid>
        <h3 class="uk-card-title">
          <span style="font-size:30px;" uk-icon="icon: world"></span> About
          @if(Auth::id() == $user->id)
            <a href="#editModal" style="margin-left:150px;" class="uk-icon-link" uk-icon="icon: pencil" uk-toggle></a>
          @endif
        </h3>
      </div>
    </div>
    <div class="uk-card-body info" uk-grid>
      <div class="uk-width-1-3 uk-grid-item-match">
        <i class="fas fa-home"></i>
        <i class="fas fa-briefcase"></i>
        <i class="fas fa-graduation-cap"></i>
        <i class="fas fa-map-marker-alt"></i>
        <i class="fas fa-heart"></i>
      </div>
      <div class="uk-width-2-3 infoCard">
        <p style="margin-top: -2px;"> {{ $user->residence ? 'Lives in '.$user->residence : 'Current residence' }}</p>
        <p> {{ $user->workplace ? 'Works at '.$user->workplace : 'Workplace' }}</p>
        <p> {{ $user->school ? 'Went to '.$user->school : 'School' }}</p>
        <p> {{ $user->birthplace ? 'Born in '.$user->birthplace : 'Birthplace' }}</p>
        <p style="margin-bottom: 3px;"> {{ $user->relationship ? 'In a relationship with '.$user->relationship : 'Relationship' }}</p>
      </div>
    </div>
  </div>
</div>
