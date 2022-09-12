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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
  
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body class="body">
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            
            @guest
            @if (Route::has('login'))
            
            
            <li>
                <a href="user-login-page" style="color:white;">
                    <i class="fas fa-user"></i>
                    Login</a>
                    <span>|</span>
                </li> 
                @endif
                
                @if (Route::has('register'))
                
                                <li>
                                    <a href="/user-register-page"  style="color:white;"><i class="fas fa-user"></i> Register</a>
                                </li>
                                @endif
                                @else
                                <a href="{{route('user-upload-video')}}" style="color:white;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Upload Video
                                    <span>|</span>
                                <a href="{{route('user-profile')}}" style="color:white;">
                                    <i class="fas fa-user"></i>
                                    Profile
                                    <span>|</span>
                                    
                                    <a href="{{route('user-edit')}}" style="color:white;">
                                        <i class="fa fa-gear"></i>
                                        Setting
                                        <span>|</span>
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;"  v-pre>
                                                <div>
                                                <img src=" {{ Auth::user()->image }}" class="fadeIn third " height="20px" width="20px">
                                                {{ Auth::user()->name }}
                                            </div>
                                        </a>
                                        
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
