<?php
$category_data = App\Models\Category::all();
?>
@extends('admin.master')
@section('title', 'Admin | Upload Video')

@section('main')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div id="wait" style="display:none;width:70px;height:90px;position:absolute;top:40%;left:45%;padding:2px;z-index:1;">
              <img src="{{asset('storage/image/Film.gif')}}" width="100" height="100" />
            </div>
            <h4 class="card-title">Upload Video</h4>
            @include('error')
            <!-- form start -->
            <form class="forms-sample" method="post" action="videoUpload" enctype="multipart/form-data" id="uploadVideoForm">
              @csrf
              <!-- video link -->

              <!-- category -->
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" id="category_id" style="padding-bottom:10px;">
                  <option>Select Category</option>
                  @foreach($category_data as $value)
                  <option value="{{$value->id}}">{{$value->category_name}}</option>
                  @endforeach
                </select>
              </div>
              <!-- video title -->
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control input_box @error('video_title') is-invalid @enderror" name="video_title" id="video_title" placeholder="Title">
                <span id="video_title_error" class="fadeIn second" style="color:red;">
              </div>
              <!-- Video -->
              <div class="form-group">
                <label>Video</label>
                <input type="file" class="form-control input_box @error('video') is-invalid @enderror" id="video" name="video" accept="video/*">
                <span id="video_error" class="fadeIn second" style="color:red;">
              </div>
              <!-- #tags -->
              <div class="form-group">
                <label>#Tag</label>
                <input type="text" class="form-control input_box @error('tag') is-invalid @enderror" id="tag" placeholder="#Tag" name="tag">
                <span id="tag_error" class="fadeIn second" style="color:red;">

              </div>
              <!-- description -->
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control input_box @error('description') is-invalid @enderror" rows="4" id="description" placeholder="Description About video" name="description"></textarea>
                <span id="description_error" class="fadeIn second" style="color:red;">
              </div>
              <!-- publishing date -->
              <div class="form-group">
                <label>Publishing Date</label>
                <input type="date" class="form-control input_box @error('published_at') is-invalid @enderror" id="published_at" placeholder="Publishing Date" name="published_at">
                <span id="published_at_error" class="fadeIn second" style="color:red;">
              </div>
              <button type="submit" class="btn btn-primary mr-2" id="videoUploaded">Submit</button>
            </form>
            <a href="/admin-panel/video-list"><button class="btn btn-light" style="float: right;">Cancel</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

<script>
  $(document).on("click", "#videoUploaded", function(e) {
    e.preventDefault();
    var form = $("#uploadVideoForm");
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
          url: "{{route('admin.videoUpload')}}",
          data: formData,
          dataType: 'JSON',
          contentType: false,
          processData: false,
          cache: false,
          beforeSend: function() {
            $("#wait").css("display", "block");
          },
          success: function(query) {
            if (query) {
              window.location.href = "video-list";
              swal("Inserted!", "Video Uploaded Successfully.", "success");
            }
            $("#wait").css("display", "none");
          },
          error: function(data) {
            $("#wait").css("display", "none");
            $('#video_title_error').text('');
            $('#video_error').text('');
            $('#description_error').text('');
            $('#tag_error').text('');
            $('#published_at_error').text('');
            $.each(data.responseJSON.errors, function(key, value) {
              $('#' + key + '_error').append('<strong>' + value + '</strong>');
            });
          }
        });
      } else {
        swal("Cancelled", "Your record is safe :)", "error");
      }
    })
  });
</script>

@endpush