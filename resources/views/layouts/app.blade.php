<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <v-toolbar>
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title>Chat</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
          @guest
            <v-btn flat href="{{ route('login') }}">Login</v-btn>
            <v-btn flat href="{{ route('register') }}">Register</v-btn>
          @else
            <v-btn flat>{{ Auth::user()->name }}</v-btn>
            <v-btn flat v-on:click="$refs.logoutForm.submit();">Logout</v-btn>
          @endguest
          <form ref="logoutForm" style="display:none;" action="{{ route('logout') }}" method="POST">
            @crsf
          </form>
        </v-toolbar-items>
      </v-toolbar>

      <main>
          @yield('main')
      </main>
    </div>
</body>
</html>
