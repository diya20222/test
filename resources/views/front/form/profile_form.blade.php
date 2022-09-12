@extends('front.layout.master')

@section('title', 'Video Cloude | Profile')

@section('content')
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <br>
                {{-- <img src="front/assets/images/background/key-2.png" height="50" width="50" alt="Avatar" class="avatar"> --}}
                <img src=" {{ Auth::user()->image }}" class="fadeIn third avatar" height="50px" width="50px">
            </div>
            <!-- Login Form -->
                @if (Route::has('user-profile'))
                    <div>
                        <label>NAME:</label>
                        {{ Auth::user()->name }}
                    </div>
                    <div>
                        <label>EMAIL:</label>
                        {{ Auth::user()->email }}
                    </div>
                    <div>
                        <label>MOBILE NUMBER:</label>
                        {{ Auth::user()->mobile }}
                    </div>
                    <a href="/home"><input type="button" class="fadeIn fourth" value="BACK"></a>
                @endif
        </div>
    </div>
@endsection
