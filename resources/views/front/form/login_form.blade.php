@extends('front.layout.master')

@section('title', 'Video Cloude | Login')

@section('content')
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <!------ Include the above in your HEAD tag ---------->
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
           
            <!-- Icon -->
            <div class="fadeIn first">
                <br>
                <img src="front/assets/images/background/key-2.png" height="50" width="50" alt="Avatar"
                    class="avatar">
            </div>
            <!-- Login Form -->
            <form action="{{ route('login') }}" method="post">
                @csrf
             
                <input type="text" id="email" class="fadeIn second @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Enter Your Email Address"><br>
                @error('email')
                    <span class="fadeIn second" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror"
                    name="password" placeholder="password"><br>
                @error('password')
                    <span class="fadeIn second" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="fadeIn third form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>
            <!-- Remind Passowrd -->
            <p style="color: red">OR</p>
            <div class="form-group row">
                <div class="col-md-6 offset-md-3">

                    <a href="{{ route('google')}}" class="btn btn-danger btn-block"><i class="fa fa-google-plus" style="font-size:21px;color:white;"></i>               Login With Google</a>
                   
                </div>
            </div>
            <div id="formFooter">
                @if (Route::has('password.request'))
                    <a class="underlineHover" href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div><br>

        </div>
    </div>
@endsection
