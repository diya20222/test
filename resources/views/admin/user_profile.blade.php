@extends('admin.master')
@section('title', 'Admin | Video List')
@section('main')

<title>Admin | User Profile</title>

<link href="{{ asset('front/assets/css/register_form.css') }}" rel="stylesheet">
<link href="{{ asset('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
<script src="{{ asset('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->
                <div class="fadeIn first">
                    <br><img src=" {{$user->image}}" class="fadeIn third avatar" height="50px" width="50px"><br>
                </div>
                <div>
                    <label>NAME:</label>{{$user->name}}
                </div>
                <div>
                    <label>EMAIL:</label>{{$user->email}}
                </div>
                <div>
                    <label>MOBILE NUMBER:</label>{{$user->mobile}}
                </div>
                <a href="/admin-panel/user-list"><input type="button" class="fadeIn fourth" value="BACK"></a>
            </div>
        </div>
    </div>
</div>

@endsection