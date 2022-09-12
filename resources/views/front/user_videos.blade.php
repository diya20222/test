@extends('front.layout.master')

@section('title', 'Video Cloude | Your Videos')

@section('content')

@if ($user_video->isNotEmpty())
<div class="container-fluid video-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row no-margin video-title">
                    <h6>
                        <i class="fas fa-home"></i>
                        Your House
                    </h6>
                </div>

                @include('error')
                <div class="video_list">

                    @foreach ($user_video as $video_item)
                    <div class="video-ro row">
                        
                        <div class="col-sm-4">
                            <div class="video-card col-md-12 col-sm-6">
                                <video width="300" height="150" controls>
                                    <source src="{{ $video_item->video }}" type="video/mp4">
                                </video>
                            </div>
                            
                        </div>
                        <div class="col-sm-8 detail" style="position:relative; left:100px;">
                            
                            <h6>{{ $video_item->video_title }}</h6>
                            <div class="counts">
                                
                                <i class="far fa-thumbs-up"></i>
                                <span>
                                    {{ App\Models\Like::with('videoLike')->where('video_id', $video_item->id)->count() }}</span>
                                    <i class="far fa-comments"></i>
                                    <span>{{ App\Models\Comment::with('videoComment')->where('video_id', $video_item->id)->count() }}</span>
                                </div>
                                <p>{{ $video_item->description }}</p>
                                <p>{{ $video_item->tag }}</p>
                                <div class="buttons">
                                    <a href="user-edit-video/{{ $video_item->id }}"><button class="btn btn-sm btn-primary">View Detail</button></a>
                                    <button class="btn btn-sm btn-danger" id="deleteVideo" video_id = "{{$video_item->id}}">Delete Video</button>
                                </div>
                                
                            </div>
                            <div class="col-sm-8 detail" style="position:relative;left:100px;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <br><br><br><br>
        <center>
            <i class='far fa-frown' style='font-size:48px;color:red'></i><br><br>
    <span style="color: red;font-size:20px;">Sorry Buddy !! You should upload atlist one Videos</span>
</center>
<br><br><br><br>
@endif

<script>
    $(document).on('click', '#deleteVideo', function() {
        var id = $(this).attr('video_id');
        var el = this;
        swal({
            text: "Are you sure want to Delete!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: 'GET',
                    url: 'user-delete-video/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data) {
                            $(".video_list").load(location.href + " .video_list");
                            $(el).closest('tr').css('background', 'tomato');
                            $(el).closest('tr').fadeOut(800, function() {
                                $(this).remove();
                            });
                            swal('Deleted!', 'user has been deleted.', 'success');
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });
</script>
@endsection