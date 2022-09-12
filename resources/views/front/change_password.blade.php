@extends('front.layout.master')

@section('title', 'Video Cloude | Details')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">

            <i class="fa fa-key" style="font-size:38px;color:skyblue"></i>
        </div>
        <br>
        @include('error')

        <!-- Change Password Form -->

        <form method="post" action="/submit-change-password" enctype="multipart/form-data">
            @csrf

            <input type="hidden" class="form-control" name="user_id" value="{{ \Auth::user()->id }}"><br>
            <!-- User old password -->
            <input type="password" id="password" class="fadeIn second" name="password" placeholder="Enter Current Password">
            @error('password')
            <span class="fadeIn second" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- User new password -->
            <input type="password" id="new_password" class="fadeIn second" name="new_password" placeholder="Enter New Password">
            @error('new_password')
            <span class="fadeIn second" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- User confirm password -->
            <input type="password" id="confirm_password" class="fadeIn third" name="confirm_password" placeholder="Enter Confirm Password">
            @error('confirm_password')
            <span class="fadeIn second" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="submit" class="fadeIn fourth" value="Done">
            {{-- <a href="/admin-panel/user-list"><button class="btn btn-light" style="float: right;">Cancel</button></a> --}}
        </form>

        <!-- Remind Passowrd -->
        {{-- <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div> --}}

    </div>
</div>


@endsection