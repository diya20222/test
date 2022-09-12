<?php
$category_data = App\Models\Category::all();
?>
@extends('admin.master')
@section('title', 'Admin | Edit Video Details')

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
            <h4 class="card-title">Edit Video Details</h4>
            <p class="card-description">
              Edit Video Details
            </p>
            <!-- form start -->
            <form class="forms-sample" method="post" action="/admin-panel/edit-video" enctype="multipart/form-data" id="EditUploadVideoForm">
              @csrf
              <!-- category -->
              <div class="form-group">
                <input type="hidden" name="id" value="{{$video->id}}">
                <input type="hidden" name="user_id" value="{{$video->user_id}}">
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" style="padding-bottom:10px;">
                  <option value="{{ $video->category->id }}" {{ $video->category_id == $video->category->id ? 'selected' : ''}}>{{ $video->category->category_name}}</option>
                  @foreach($category_data as $value)
                  <option value="{{$value->id}}">{{$value->category_name}}</option>
                  @endforeach
                </select>
              </div>
              <!-- video title -->
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="video_title" id="video_title" placeholder="Title" value="{{$video->video_title}}">
                <span id="video_title_error" class="fadeIn second" style="color:red;">
              </div>
              <!-- #tags -->
              <div class="form-group">
                <label>#Tag</label>
                <input type="text" class="form-control" id="tag" placeholder="#Tag" name="tag" value="{{$video->tag}}">
                <span id="tag_error" class="fadeIn second" style="color:red;">
              </div>
              <div class="form-group">
                <label>Video</label>
                <input type="file" class="form-control" id="video" name="video">
                <span id="video_error" class="fadeIn second" style="color:red;">
                  <video width="300" id="put-video" height="200" controls>
                    <source src="{{$video->video}}" type="video/mp4">
                  </video>
              </div>
              <!-- description -->
              <div class="form-group">
                <label>Description</label>
                <textarea style="width: 100%; height: 150px;" class="form-control" placeholder="Description About video" name="description">{{$video->description}}</textarea>
                <span id="description_error" class="fadeIn second" style="color:red;">
              </div>
              <!-- publishing date -->
              <div class="form-group">
                <label>Publishing Date</label>
                <input type="date" class="form-control" rows="4" id="published_at" placeholder="Publishing Date" name="published_at" value="{{$video->published_at}}">
                <span id="published_at_error" class="fadeIn second" style="color:red;">
              </div>
              <button type="submit" class="btn btn-primary mr-2" id="updatedVideo">Update</button>
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
  $(document).on("click", "#updatedVideo", function(e) {
    e.preventDefault();
    var form = $("#EditUploadVideoForm");
    var formData = new FormData(form[0]);
    swal({
      title: "Are you sure?",
      text: "you want to Update Video Details!",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update!',
      cancelButtonText: "No, cancel plx!",
      reverseButtons: true
    }).then((result) => {

      if (result) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          url: "{{route('admin.edit-video')}}",
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
              window.location.href = "{{ route('admin.video-list')}}";
              swal("Updated!", "Your Video Updated Successfully.", "success");
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