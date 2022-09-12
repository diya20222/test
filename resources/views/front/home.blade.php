@extends('front.layout.master')

@section('title', 'Video Cloude | Home')
 
@section('content')
    <!--####################### Slider Starts Here ###################-->
    @include('error')
    @include('front.layout.slider_videos')
    @include('front.layout.comedy_videos')
    @include('front.layout.sports_videos')
    @include('front.layout.animals_videos')
    @include('front.layout.education_videos')
    @include('front.layout.vehicales_videos')
    @include('front.layout.style_howTo_videos')
    @include('front.layout.gaming_videos')
@endsection