<?php
$comedy_v = comedy_videos();
$comedy_video_slide = $comedy_v['comedy_videos'];
?>

@if ($comedy_video_slide->isNotEmpty())
<div class="treanding-video container-fluid">
    <div class="container">
        <div class="row video-title no-margin">
            <h6 id="comedy">
                <i class="fas fa-book"></i>
                Comedy Videos
            </h6>
        </div>
        <div class="video-row row">
            @foreach ($comedy_video_slide->take(4) as $object)
            {{-- @dd($object) --}}
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
                                <span> {{$object->published_at}}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endif