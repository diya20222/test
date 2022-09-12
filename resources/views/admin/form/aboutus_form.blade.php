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
                       
                        <h1 class="card-title" style="font-size: 30px;">Website Settings</h1>
                        <!-- form start -->
                        <form class="forms-sample" method="post" action="aboutusSubmit" enctype="multipart/form-data" id="aboutusForm">
                            @csrf
                            <input type="hidden" class="form-control" name="aboutus_id" id="s" value="{{$aboutus->id}}"><br>


                            <h4 class="card-title">About Us</h4>
                       
                            <!-- Website Logo -->
                            <div class="form-group">
                                <label for="exampleInputPassword">Title</label><br>
                                <input type="text" class="form-control" id="title" name="title" value="{{$aboutus->title}}">
                                <span id="title_error" style="color:red;">

                                </span>
                                {{-- <img src="{{$setting->logo}}" alt="" height="150" width="400"> --}}


                            </div>
                            <h4 class="card-title">Description</h4>
                            <!-- website -->
                            <div class="form-group">
                                <label for="exampleInputPassword">description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{$aboutus->description}}">
                                <span id="description_error" style="color:red;"></span>
                            </div>
                            <!-- service time -->
                            <h4 class="card-title">Company Image</h4>
                            <div class="form-group">
                                <input type="file" class="form-control" id="image" name="image" value="{{$aboutus->image}}"><br>
                            <img src="{{$aboutus->image}}" alt="" height="150" width="400"> 

                            </div>
                            <button type="submit" class="btn btn-primary mr-2" id="updateAboutus">Update</button>
                        </form>
                        <a href="/admin-panel/index"><button class="btn btn-light" style="float: right;">Cancel</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    $(document).on("click", "#updateAboutus", function(e) {
        e.preventDefault();
        var form = $("#aboutusForm");
        var formData = new FormData(form[0]);
        swal({
            title: "Are you sure?",
            text: "you want to Update Settings!",
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
                    url: "{{route('admin.update_aboutus')}}",
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
                            window.location.href = "/admin-panel/index";
                            swal("Inserted!", "Setting Changed Successfully.", "success");
                        }
                        $("#wait").css("display", "none");
                    },
                    error: function(data) {
                        $("#wait").css("display", "none");
                        $('#logo_error').text('');
                        $('#website_error').text('');
                        $('#service_time_error').text('');
                        $('#linkedln_error').text('');
                        $('#twitter_error').text('');
                        $('#facebook_error').text('');
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