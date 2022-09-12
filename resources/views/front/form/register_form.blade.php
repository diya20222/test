@extends('front.layout.master')

@section('title', 'Video Cloude | Register')

@section('content')
    <!------ Include the above in your HEAD tag ---------->
    {{-- @extends('layouts.app') --}}
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <br>
                <img src="front/assets/images/background/lock.png" height="50" width="50" alt="Avatar"
                    class="avatar">
            </div>

            <!-- Login Form -->

            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" id="id" class="fadeIn second @error('id') is-invalid @enderror" name="id"
                    placeholder="User id"><br>
                <input type="text" id="name" class="fadeIn second @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" placeholder="Enter User Name"><br>
                @error('name')
                    <span class="fadeIn second" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror


                <input type="text" id="email" class="fadeIn second @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" name="email" placeholder="Enter Email Address"><br>
                @error('email')
                    <span class="fadeIn second" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <input type="text" id="mobile" class="fadeIn second @error('mobile') is-invalid @enderror"
                    value="{{ old('mobile') }}" name="mobile" placeholder="Enter Mobile Number"><br>
                @error('mobile')
                    <span class="fadeIn second" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror

                <input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror"
                    value="{{ old('password') }}" name="password" placeholder="Enter Strong Password"><br>
                @error('password')
                    <span class="fadeIn second" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <input type="password" id="password-confirm" class="fadeIn third @error('password') is-invalid @enderror"
                    value="{{ old('password_confirmation') }}" name="password_confirmation"
                    placeholder="Enter Confirm Passsword"><br>
                @error('password')
                    <span class="fadeIn second" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror

                <input type="file" id="image" class="fadeIn third @error('image') is-invalid @enderror" name="image"
                    placeholder="select image" value="{{ old('image') }}"><br>
                @error('image')
                    <span class="fadeIn second" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror

                <input type="submit" class="fadeIn fourth" value="Registration">

            </form>

            <!-- Remind Passowrd -->
            {{-- <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div> --}}
        </div>
    </div>
@endsection
