<?php
$slide_video = sliderMainVideo();
$main_video = $slide_video['slider_main_video'];

$side_video = $slide_video['slider_side_video'];
// dd($main_video->category_id)
?>
<div class="banner-card container-fluid">
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-9 banner-slid">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if (@$main_video->category_id == 1)
                                <a href="{{ route('detail', $main_video->slug) }}">
                                    <video width="800" height="340" controls>
                                        <source src={{ $main_video->video }} type="video/mp4">
                                    </video>
                                    <p>{{ @$main_video->video_title }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 vgbh">
                <div class="row">
                    <div class="video-card col-md-12 col-sm-6">



                        @foreach (@$side_video as $object)
                            <a href="{{ route('detail', $object->slug) }}">
                                <video width="300" height="150" controls>
                                    {{-- @dd($object->video) --}}
                                    <source src={{ $object->video }} type="video/mp4">
                                </video>
                                <p>{{ $object->video_title }}</p>

                        @endforeach

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
