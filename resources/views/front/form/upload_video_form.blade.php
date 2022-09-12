<?php
$category_data = App\Models\Category::all();
?>
@include('front.layout.header')
<meta charset="utf-8">
<title>Video Cloud | Upload Video</title>
<link href="front/assets/css/register_form.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="front/assets/css/fontawsom-all.min.css">
<link rel="stylesheet" href="front/assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="front/assets/css/style.css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <!-- Icon -->
        <div class="fadeIn first">
            <br>
            <img src="{{ Auth::user()->image }}" class="fadeIn third avatar" height="50px" width="50px">
        </div>
        <!-- Login Form -->
        <form action="{{ route('store.video') }}" id="form_video" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="user_id" class="fadeIn second " name="user_id" placeholder="Enter User Name"
                value="{{ Auth::user()->id }}"><br>
            <input type="text" id="video_title" class="fadeIn second " name="video_title" placeholder="Enter video title"
                value="{{ old('video_title') }}"><br>
            <span class="fadeIn second" id="video_title_error" style="color:red;"></span>
            <input type="text" id="tag" class="fadeIn second " name="tag" placeholder="Enter video tag"
                value="{{ old('tag') }}"><br>
            <span class="fadeIn second" id="tag_error" style="color:red;"></span>

            <textarea type="text" id="description" class="fadeIn second" name="description"
                placeholder="Enter video description" value="{{ old('description') }}"></textarea><br>
            <span class="fadeIn second" id="description_error" style="color:red;"></span>
            <select name="category_id" id="category_id" class="fadeIn second" style="padding-bottom:10px;">
                <option>Select Category</option>
                @foreach ($category_data as $value)
                    <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                @endforeach
            </select>

            <input type="file" name="video" id="video" value="{{ old('video') }}"><br>
            <span class="fadeIn second" id="video_error" style="color:red;">
            </span>

            <input type="date" id="published_at" class="fadeIn third datepicker" name="published_at"
                value="{{ old('published_at') }}"><br>
            <span class="fadeIn second" id="published_at_error" style="color:red;">

            </span>
            <input type="button" class="fadeIn fourth videoSubmit" id="videoSubmit" value="SUBMIT">
        </form>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    
            //
    $(function() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();
            var maxDate = year + '-' + month + '-' + day;
            $('#published_at').attr('max', maxDate);
        });

    $(document).on('click', '#videoSubmit', function() {
        var form = $('#form_video');
        var formData = new FormData(form[0]);
        swal({
            title: "Are you sure?",
            text: "you want to Upload Video!",
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
                    url: "{{ route('store.video') }}",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(query) {
                        if (query) {
                            swal("Inserted!", "Video Uploaded Successfully.", "success");
                            window.location.href = "user-videos";
                        }
                    },
                    error: function(data) {
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
    });


   
</script>
