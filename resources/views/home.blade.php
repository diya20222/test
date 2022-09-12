<meta charset="utf-8">
<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>
    Video Streamimg Website Template | Smarteyeapps.com</title>
<link rel="shortcut icon" href="front/assets/images/fav.jpg">
<link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="front/assets/css/fontawsom-all.min.css">
<link rel="stylesheet" href="front/assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="front/assets/css/style.css"/>
@include('front.layout.header')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
