<?php
$category_data = App\Models\Category::all();
?>
@include('front.layout.header')
@include('style')

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Icon -->
        <div class="fadeIn first">
            <br>
        </div>
        <!-- Login Form -->
        <form action="/user-edit-video" id="editVideoForm" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"><br>
            <input type="hidden" id="id" name="id" value="{{ $video->id }}"><br>

            <input type="text" id="video_title" class="fadeIn second " name="video_title" placeholder="Enter video title" value="{{ $video->video_title }}"><br>
            <span id="video_title_error" class="fadeIn second" style="color:red;"></span>
            <br>

            <input type="text" id="tag" class="fadeIn second" name="tag" placeholder="Enter video tag" value="{{ $video->tag }}"><br>
            <span id="tag_error" class="fadeIn second" style="color:red;"></span>
            <br>

            <textarea type="text" id="description" class="fadeIn second " name="description" placeholder="Enter video description">{{ $video->description }}</textarea><br>
            <span class="fadeIn second" id="description_error" style="color:red;"></span>
            <br>

            <select name="category_id" class="fadeIn second" style="padding-bottom:10px;">
                <option value="{{ $video->category->id }}" {{ $video->category_id == $video->category->id ? 'selected' : ''}}>{{ $video->category->category_name}}</option>
                @foreach($category_data as $value)
                <option value="{{$value->id}}">{{$value->category_name}}</option>
                @endforeach
            </select><br>

            <input type="file" class="fadeIn second" name="video" id="video" value="{{ $video->video }}"><br>
            <span class="fadeIn second" id="video_error" style="color:red;"></span>

            <input type="date" id="published_at" class="fadeIn second" name="published_at" value="{{ $video->published_at }}"><br>
            <span class="fadeIn second" id="published_at_error" style="color:red;"></span>
            <br>
            <input type="button" id="editVideo" class="fadeIn fourth" value="SUBMIT">
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).on('click', '#editVideo', function() {

        var form = $('#editVideoForm');
        var formData = new FormData(form[0]);

        swal({
            title: "Are you sure?",
            text: "you want to Update Video!",
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
                    url: "/user-edit-video",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(query) {
                        if (query) {
                            swal("Updated !!", "Video Uploaded Successfully.", "success");
                            window.location.href = "/user-videos";
                        }
                    },
                    error: function(data) {
                        $('#video_title_error').text('');
                        $('#video_error').text('');
                        $('#description_error').text('');
                        $('#tag_error').text('');
                        $('#published_at_error').text('');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#' + key + '_error').append(
                                '<strong>' + value + '</strong>');
                        });
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        });
    })
</script>