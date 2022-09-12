<?php
$animals_v = animals_videos();
$animals_video_slide = $animals_v['animals_videos'];
?>

<div class="treanding-video container-fluid">
    @if($animals_video_slide->isNotEmpty())


    <div class="container">
        <div class="row no-margin video-title">
            <h6 id="animals">
                <i class="fas fa-book"></i>
                Animals Videos
            </h6>
        </div>
        <div class="video-row row">
            @foreach ($animals_video_slide->take(4) as $object)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="video-card">
                    <a href="{{ route('detail', $object->slug) }}">
                        <video width="250" height="200" controls>
                            <source src={{ $object->video }} type="video/mp4">
                        </video>
                        <p>{{ $object->video_title }}</p>
                        <div class="row details no-margin">
                            <div class="col-md-12 left">
                                <span>{{$object->description}}</span>
                            </div>
                        </div>
                        <div class="row details no-margin">
                            <div class="col-md-12 left">
                            <i class="fa fa-hashtag" aria-hidden="true"></i>
                                <span>{{$object->tag}}</span>
                            </div>
                        </div>
                        <div class="row details no-margin">
                            <div class="col-md-12 left">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>  {{$object->published_at}}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>