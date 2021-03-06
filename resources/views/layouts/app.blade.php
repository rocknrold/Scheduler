<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="google-signin-client_id" content="583439515778-ip59hm3jlhqg1hm3vbcdme433mcu0irj.apps.googleusercontent.com">
    {{-- <meta name="google-signin-client_id" content="454455940038-q8kdrp7b3um8dimq4adus1sucfilr35p.apps.googleusercontent.com"> --}}


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scheduler') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <!-- GOOGLE CHARTS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/c88097f817.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body>

<script>
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
        console.log('User signed out.');
            jQuery(function($){
                $.ajax({
                    type:'POST',
                    url:'/logout',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){  window.location.replace("/login"); },
                    error:function(data){console.log(data)},
                });
            });
        });
    }
    function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
    </script>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Scheduler') }}
            </a>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                </li>
                    @else
                <li class="nav-item" style="padding-left:10px;">
                        @if(Auth::user()->type == "google")
                            <img src="{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:left; top:10px; left:10px; border-radius:50%">
                        @endif
                        {{ Auth::user()->name }}
                       |
                        @if(Auth::user()->type == "sched")
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @elseif(Auth::user()->type == "google")
                            <a href="#" onclick="signOut();">Sign out</a>
                        @endif
                    @endguest
                </li>
            </ul>                       
        </nav>
            <main>
                @yield('content')
            </main>
    {{-- <main> --}}
    @yield('home')
    {{-- </main> --}}
    </div>

    {{-- YIELDS SCRIPTS --}}
    @yield('scripts')
    {{-- GOOGLE PLATFORM IDENTITY API --}}
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</body>
</html>
