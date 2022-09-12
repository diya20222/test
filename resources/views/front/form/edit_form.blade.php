@extends('front.layout.master')

@section('title', 'Video Cloude | Home')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <br>
            <img src=" {{ Auth::user()->image }}" class="fadeIn third avatar" height="50px" width="50px">
        </div>
        <!-- Login Form -->
        <form action="submit-edit" method="post" enctype="multipart/form-data">
            @csrf
            {{-- @if ($errors->any())
                     @dd($errors->all())
                     @endif --}}
            <input type="hidden" id="id" class="fadeIn second @error('id') is-invalid @enderror" name="id"
                placeholder="Enter User Name" value="{{ Auth::user()->id }}"><br>


            <input type="text" id="name" class="fadeIn second @error('name') is-invalid @enderror" name="name"
                placeholder="Enter User Name" value="{{ Auth::user()->name }}"><br>
            @error('name')
                <span class="fadeIn second" style="color:red;">
                    <strong>{{ $message }}</strong>
                </span>
                <br>
            @enderror
            <input type="text" id="email" class="fadeIn second @error('email') is-invalid @enderror" name="email"
                placeholder="Enter Email Address" value=" {{ Auth::user()->email }}"><br>
            @error('email')
                <span class="fadeIn second" style="color:red;">
                    <strong>{{ $message }}</strong>
                </span>
                <br>
            @enderror
            <input type="text" id="mobile" class="fadeIn second @error('mobile') is-invalid @enderror" name="mobile"
                placeholder="Enter Mobile Number" value="{{ Auth::user()->mobile }}"><br>
            @error('mobile')
                <span class="fadeIn second" style="color:red;">
                    <strong>{{ $message }}</strong>
                </span>
                <br>
            @enderror
            <input type="file" id="image" class="fadeIn third @error('image') is-invalid @enderror" name="image"
                placeholder="select image" value="{{ Auth::user()->image }}"><br>
            @error('image')
                <span class="fadeIn second" style="color:red;">
                    <strong>{{ $message }}</strong>
                </span>
                <br>
            @enderror
            <input type="submit" class="fadeIn fourth" value="SUBMIT">
        </form>
    </div>
</div>
@endsection