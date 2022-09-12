<?php
$category = category();
$category_dropdown = $category['category'];

$settings_details = App\Models\Setting::get()->first();
// dd($settings_details->logo);
?>
<header class="continer-fluid ">
    <div class="header-top">

        <div class="container">
            <div class="row col-det">
                <div class="col-lg-6 d-none d-lg-block">
                    <ul class="ulleft">
                        <li>
                            <i class="far fa-envelope"></i>
                            {{$settings_details->website}}
                            <span>|</span>
                        </li>
                        <li>
                            <i class="far fa-clock"></i>
                            Service Time : {{$settings_details->service_time}}
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="ulright">
                        @if (Auth::user())

                        <li>
                            <a href="{{ route('user-upload-video') }}" style="color:white;">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Uploadd Video
                                <span>|</span>
                            </a>
                            <a href="{{ route('user-profile') }}" style="color:white;">
                                <i class="fas fa-user"></i>
                                Profile
                                <span>|</span>
                                <a href="{{ route('user-edit') }}" style="color:white;">
                                    <i class="fa fa-gear"></i>
                                    Setting
                                    <span>|</span>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;" v-pre>
                                <div>
                                    <img src=" {{ Auth::user()->image }}" class="fadeIn third " height="20px" width="20px">
                                    {{ Auth::user()->name }}
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/logout" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <a class="dropdown-item" href="/change-password/{{ Auth::user()->id }}">
                                    {{ __('Change Password') }}
                                </a>
                                <form id="logout-form" action="/logout" method="POST">
                                    @csrf
                                </form>
                        </li>
                        @endif

                        @if (!Auth::user())
                        <li>
                            <a href="/user-register-page" style="color:white;"><i class="fas fa-user"></i>
                                Register
                                <span>|</span></a>
                        </li>
                        <li>
                            <a href="/user-login-page" style="color:white;">
                                <i class="fas fa-user"></i>
                                Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- @dd($settings_details->logo) --}}
    <div class="header-bottom">
        <div class="container">
            <div class="row nav-row">
                <div class="col-md-3 logo">
                    <a href="/"><img src="{{$settings_details->logo}}" height="50px" width="300px" alt=""></a>
                    {{-- <img src="{{$settings_details->logo}}" class="fadeIn third " height="20px" --}}
                    {{-- width="20px"> --}}
                </div>
                <div class="col-md-9 nav-col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about-us">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="/">Category</a>


                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#comedy">Comedy</a></li>
                                <li><a class="dropdown-item" href="#sports">Sports</a></li>
                                <li><a class="dropdown-item" href="#animals">Animals</a></li>
                                <li><a class="dropdown-item" href="#education">Education</a></li>
                                <li><a class="dropdown-item" href="#vehicales">Vehicales</a></li>
                                <li><a class="dropdown-item" href="#sh">Style & HowTo</a></li>
                                <li><a class="dropdown-item" href="#gaming">Gaming</a></li>
                            </ul>

                        </li>
                        @if (Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user-videos') }}">Videos</a>
                        </li>
                        @endif
                        </ul>
                </div>
                </nav>
            </div>
        </div>
    </div>
    </div>
</header>