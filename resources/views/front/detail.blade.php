@extends('front.layout.master')
@section('title', 'Video Cloude | Details')
@section('content')

    <!--####################### Video Blog Starts Here ###################-->
    <div class="container-fluid video-blog">
        @include('error')
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row no-margin">
                        <div class="col-md-12 banner-slid">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <video width="700" height="400" controls>
                                            <source src="{{ $trending_video_slide->video }}" type="video/mp4">
                                        </video>
                                        <span style="color: blue;">{{ $trending_video_slide->tag }}</span><br>
                                        <span style="font-size:20px;">{{ $trending_video_slide->video_title }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr style="color: black;">
                        </div>
                        <div class="form-inline">
                            <label class="text-right" style="position:relative;"><br>
                                {{ App\Models\Like::with('videoLike')->where('video_id', $trending_video_slide->id)->count() }}
                                Likes</label>
                            @if (Auth::user())
                                @if ($like_user)
                                    <a href="{{ route('user_dislike', $trending_video_slide->id) }}">
                                        <i class="fa fa-thumbs-up like"
                                            style="font-size:25px;color:red; position:relative; margin-left:630px;"></i>
                                    </a>
                                @else
                                    <a href="{{ route('user_like', $trending_video_slide->id) }}">
                                        <i class="fa fa-thumbs-up like"
                                            style="font-size:25px;color:black; position:relative; margin-left:630px;"></i>
                                    </a>
                                @endif
                            @endif
                        </div>
                        <hr><br>
                        <span
                            style="font-size: 16px;position:relative;">{{ $trending_video_slide->description }}</span><br>
                        @if (Auth::user())
                            @if (route('detail', $trending_video_slide->slug))
                                @include('front.form.commentbox_form')
                            @endif
                        @endif
                        <div class="row no-margin video-title" bis_skin_checked="1">
                            <h6 style="position:relative; margin-right: 600px;"><br><br><i class="fas fa-book"></i>
                                {{ App\Models\Comment::with('videoComment')->where('video_id', $trending_video_slide->id)->count() }}
                                Comments</h6>
                        </div>
                        <div class="anyClass showComments">
                            @foreach ($trending_video_slide->videoComment as $comment)

                                <div class="comment-container">
                                    <div class="comment-box row">
                                        <div class="col-2 mghji">
                                            <img src=" {{ $comment->image }}" class="fadeIn third " height="70px"
                                                width="70px">
                                        </div>
                                        <div class="col-10 detaila comment_parent_div">
                                            @if (Auth::user())
                                            @if ($comment->user_id == Auth::user()->id)
                                          
                                                    <div class="dropright float-right">
                                                        <button type="button" class="dropdown-toggle float-right"
                                                            style="border: none; color: red; font-size:20px;"
                                                            data-toggle="dropdown">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <h5 class="dropdown-header">Action</h5>
                                                            <a class="dropdown-item js_edit_comment"
                                                                href="{{ route('edit-comment', $comment->id) }}">Edit</a>
                                                            <a class="dropdown-item" id="js_delete_comment"
                                                                delete_comment="{{ $comment->id }}">Delete</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <h6>{{ $comment->name }}</h6>
                                            <small>Published on 19-06-2019</small>
                                            <p class="my_comment_id" hidden>{{ $comment->id }}</p>
                                            <p class="my_comment">{{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row no-margin video-title">
                        <h6><i class="fas fa-book"></i> Related Videos</h6>
                    </div>
                    <div class="col-md-3 vgbh">
                        <div class="row">
                            @foreach ($side_video_slide->take(5) as $object)
                                <a href="{{ route('detail', $object->slug) }}">
                                    <div class="video-card col-md-12 col-sm-6">
                                        <video width="300" height="150" controls>
                                            <source src="{{ $object->video }}" type="video/mp4">
                                        </video>
                                        <p style="font-size:16px; color:black;">{{ $object->video_title }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        console.log(123);
        $('#update_comment').hide();
        $(document).on('click', '.js_edit_comment', function(e) {
            e.preventDefault();
            var parent_div = $(this).parents('.comment_parent_div');
            var comment = parent_div.find('.my_comment').text();
            var comment_id = parent_div.find('.my_comment_id').text();
            $("#update_comment").show();
            $("#post_comment").hide();
            $("#my_comment_box").val(comment);
            $("#my_comment_id").val(comment_id);
        })

        $(document).on('click', '#js_delete_comment', function() {

            var id = $(this).attr('delete_comment');
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
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        dataType: "JSON",
                        url: "{{ route('delete-comment-user') }}",
                        data: {
                            'id': id
                        },
                        cache: false,
                        success: function(data) {
                            if (data) {
                                $(".showComments").load(location.href + " .showComments");
                                $(el).closest('tr').css('background', 'tomato');
                                $(el).closest('tr').fadeOut(800, function() {
                                    $(this).remove();
                                });
                                swal(
                                    'Deleted!',
                                    'user has been deleted.',
                                    'success'
                                )
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
