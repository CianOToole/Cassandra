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
    <script src="{{ asset('js/search.js') }}" defer></script>    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <nav>
            <div class="logo">
                <a class="" href="{{ url('/') }}" >
                    <img src="../../storage/Logo.svg" width="60px" height="60px"/>
                </a>
            </div>

            @auth
                <form id="searchStock" class="search-stock" method="GET" action=""  >
                    <input id="searchBar" type="search" class="form-control" autocomplete="off">
                    <ul id="searchGroup"></ul>
                </form>
            @endauth

            <div class="navbar">

                <ul class="nav-links">   
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item login-register">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        
                        @if (Route::has('register'))
                            <li class="nav-item login-register">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                        @else

                        @auth

                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))    
                                <div class="dropdown">
                                    <li class="lg-items drop-btn">
                                        <button  id="" class="" > Users</button>
                                    </li>

                                    <div class="dropdown-content">
                                        @auth
                                        @if (Auth::user()->hasRole('admin'))
                                            <li><a class="" href="{{ route('admin.moderators.index') }}">Moderators</a></li>
                                            <li><a class="" href="{{ route('admin.clients.index') }}">Suscribers</a></li>
                                        @endif
                                        @if (Auth::user()->hasRole('moderator'))
                                            <li><a class="" href="{{ route('admin.moderators.index') }}">Moderators</a></li>
                                            <li><a class="" href="{{ route('admin.clients.index') }}">Suscribers</a></li>
                                        @endif
                                        @endauth
                                    </div>
                                </div>                                
                            @endif
    
                                <li class="lg-items" style="padding-left: 15px;">
                                    <a class="" href="#">Portfolio</a>    
                                </li>

                                <div class="dropdown">
                                    <li class="lg-items drop-btn">
                                        <button  id="" class="">Forum</button>
                                    </li>

                                    <div class="dropdown-content">
                                        <li class="lg-items">
                                            <a class="" href="{{route('forum.index')}}">Boards</a>
                                        </li>                                   
                                        <li class="lg-items">
                                            <a class="" href="{{route('news')}}">Newsfeed</a>
                                        </li>   
                                    </div>
                                </div>   

                                <li class="lg-items" style="padding-left: 15px;">
                                    <a class="" href="#">Watchlist</a>                                
                                </li>
                            
                            {{-- PROFILE --}}
                    
                            <li class="nav-item dropdown lg-items">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src=" {{ asset('storage/avatar/' . Auth::user()->avatar) }} " width='30px' height="30px" 
                                        style="object-fit: fill;" class = "rounded-circle mr-1 ">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right profile-items" aria-labelledby="navbarDropdown">

                                    @auth
                                        @if (Auth::user()->hasRole('admin'))
                                            <a class="dropdown-item profile" href="{{ route('admin.profiles.index') }}">Profile
                                            <i class="fas fa-user"></i>
                                        </a>
                                        @endif
                                        @if (Auth::user()->hasRole('moderator'))
                                            <a class="dropdown-item profile" href="{{ route('moderator.profiles.index') }}">Profile
                                            <i class="fas fa-user"></i>
                                        </a>
                                        @endif
                                        @if (Auth::user()->hasRole('client'))
                                            <a class="dropdown-item profile" href="{{ route('client.profiles.index') }}">Profile
                                            <i class="fas fa-user"></i>
                                        </a>
                                        @endif
                                    @endauth

                                    <a class="dropdown-item logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        Logout                                        
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            {{-- PROFILE --}}

                        @endauth                
                        <li id="dropMenu" class="hamburger">
                            <button>
                                <h3>&#9776;</h3>
                            </button>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <div id="responsiveNavbar" class="responsive-navbar" >
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
                @auth
                    
                    @if (Auth::user()->hasRole('admin'))
                        <li><a class="" href="{{ route('admin.moderators.index') }}">Moderators</a></li>
                        <li><a class="" href="{{ route('admin.clients.index') }}">Suscribers</a></li>
                    @endif
                    @if (Auth::user()->hasRole('moderator'))
                        <li><a class="" href="{{ route('admin.clients.index') }}">Suscribers</a></li>
                    @endif

                    <li class="lg-items"><button  id="" class="">Portfolio</button></li>

                    <li class="lg-items"><a class="" href="#">Watchlist</a></li>

                    <li class="lg-items"><a class="" href="{{route('forum.index')}}">Boards</a></li>

                    <li class="lg-items"><a class="" href="{{route('news')}}">News</a></li>

                    <li>
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
                    </li>


                    <li class="lg-items">
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }} 
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                
                @endauth
            @endguest
        </div>

        <main id="mainContainer"class="py-4">
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

<script src="posts.js"></script>

</html>
