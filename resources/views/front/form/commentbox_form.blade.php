<div class="row video-title" bis_skin_checked="1">
    <h6 style="position:relative; margin-right: 600px;"><br><i class="fas fa-book"></i> Post Your Comment</h6>
</div>

<div class="comment-text">
    <form method="post" id="commentId" action="{{ route('commentSubmit', $trending_video_slide->slug) }}" enctype="multipart/form-data">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="form-row row">
            <input type="hidden" id="my_comment_id" name="my_comment_id" class="form-control form-control-sm"><br>
            <textarea placeholder="Enter Comment" rows="5" name="comment" style="color: black;" class="form-control form-control-sm" id="my_comment_box"></textarea>
        </div>
        <div class="form-row row">
            <button class="btn btn-danger" type="button" id="update_comment">Update Comment</button>
            <button class="btn btn-danger" type="submit" id="post_comment">Post Comment</button>
        </div>
    </form>
</div>
<script>
    //post comment ajax
    $(document).on('click', '#post_comment', function(e) {
        e.preventDefault();
        var form = $('#commentId');
        var formData = new FormData(form[0]);
        swal({
            title: "Are you sure?",
            text: "you want to Post a Comment!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save!',
            cancelButtonText: "No, cancel plx!",
            reverseButtons: true
        }).then((result) => {

            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('commentSubmit', $trending_video_slide->slug) }}",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(query) {
                        
                        if (query.comment) {
                      
                            $(".showComments").load(location.href + " .showComments");
                            $('#my_comment_box').val('');
                            swal("Inserted!", "Comment Posted Successfully.", "success");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });
    //update comment ajax
    $(document).on('click', '#update_comment', function() {
        var form = $('#commentId');
        var formData = new FormData(form[0]);
        swal({
            title: "Are you sure?",
            text: "you want to update Post a Comment!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save!',
            cancelButtonText: "No, cancel plx!",
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('commentSubmit', $trending_video_slide->slug) }}",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(query) {
                        if (query.comment_update) {
                            // window.location.href = "{{ url()->current() }}";
                            $(".showComments").load(location.href + " .showComments");
                            $('#my_comment_box').val('');
                            swal("Updated!", "Your Comment Uploaded Successfully.",
                                "success");
                            $("#update_comment").hide();
                            $("#post_comment").show();
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });
</script>