<!doctype html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h3 class="home-link">Cassandra</h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto navigation">
                        @auth
                            @if (Auth::user()->hasRole('admin'))
                                <li><a href="{{route('admin.moderators.index')}}">Moderators</a></li>    
                                <li><a href="{{route('admin.clients.index')}}">Users</a></li>    
                            @endif
                            @if (Auth::user()->hasRole('moderator'))
                                <li><a href="{{route('moderator.clients.index')}}">Users</a></li>    
                            @endif
                            {{-- @if (Auth::user()->hasRole('patient'))
                                <li><a href="{{route('patient.visits.index')}}">Visits</a></li>    
                            @endif --}}
                        @endauth
                        {{-- <li><a href="{{route('about')}}">About Us</a></li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src=" {{ asset('storage/avatar/' . Auth::user()->avatar) }} " width='30px' height="30px" 
                                        style="object-fit: fill;"" class = "rounded-circle mr-1">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @auth
                                        @if (Auth::user()->hasRole('admin'))
                                            <a class="dropdown-item" href="{{ route('admin.profiles.index') }}">Profile</a>
                                        @endif
                                        @if (Auth::user()->hasRole('moderator'))
                                            <a class="dropdown-item" href="{{ route('moderator.profiles.index') }}">Profile</a>
                                        @endif
                                        @if (Auth::user()->hasRole('client'))
                                            <a class="dropdown-item" href="{{ route('client.profiles.index') }}">Profile</a>
                                        @endif
                                    @endauth

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row-justify-content-center">
                    <div class="col-md-12">
                        <div class="flash-message">
                            @foreach (['success', 'info', 'danger', 'warning'] as $key)
                                @if(Session::has($key))
                                    <div class="flash alert alert-{{$key}}">{{ Session::get($key) }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    </div>
                                @endif                                                            
                            @endforeach    
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>

    </div>
</body>

<script src="https://kit.fontawesome.com/b0365a380f.js" crossorigin="anonymous"></script>
<script>
    setTimeout(function(){ $('.flash').alert('close') }, 3000); 
</script>

</html>
