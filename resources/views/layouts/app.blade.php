<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    	<title>@yield('title') | Eindwebs</title>
    @else
    	<title>Eindwebs</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/js/uikit.min.js"></script>
    <script src="/js/uikit-icons.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/uikit-rtl.min.css">
    <link rel="stylesheet" href="/css/uikit.min.css">

</head>
<body>
    <div id="app">
      <v-toolbar>
          <v-toolbar-title> Eindwebs</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items class="hidden-sm-and-down">
                  @guest
                      <v-btn flat href="{{ route('login') }}">Login</v-btn>
                      <v-btn flat href="{{ route('register') }}">Register</v-btn>
                  @else
                      <v-btn flat href="{{ route('chat.group') }}">Group</v-btn>
                      <v-btn flat href="{{ route('chat.private') }}">Private</v-btn>
                      <v-btn flat href="{{ route('profile.index', ['user' => Auth::id() ]) }}"> {{ Auth::user()->name }}</v-btn>
                      <v-btn flat @click=" $refs.logoutForm.submit(); ">Logout</v-btn>
                  @endguest
                  <form ref="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
          </v-toolbar-items>
      </v-toolbar>

      <main>
          <v-container fluid>
              @if(hasMessage())
                {!! getMessage() !!}
              @endif

              @yield('main')
          </v-container>
      </main>

    </div>

    @hasSection('scripts.footer')
        @yield('scripts.footer')
    @endif
</body>
</html>
