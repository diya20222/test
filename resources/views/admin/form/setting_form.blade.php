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
                        <form class="forms-sample" method="post" action="settingSubmit" enctype="multipart/form-data" id="settingForm">
                            @csrf
                            <input type="hidden" class="form-control" name="setting_id" id="s" value="{{$setting->id}}"><br>


                            <h4 class="card-title">Website Logo</h4>


                            <!-- Website Logo -->
                            <div class="form-group">
                                <label for="exampleInputPassword">Logo</label><br>
                                <input type="file" class="form-control" id="logo" name="logo" value="{{$setting->logo}}">
                                <span id="logo_error" style="color:red;">

                                </span>
                                <img src="{{$setting->logo}}" alt="" height="150" width="400">


                            </div>
                            <h4 class="card-title">Header Content</h4>
                            <!-- website -->
                            <div class="form-group">
                                <label for="exampleInputPassword">Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="website@gmail.com" value="{{$setting->website}}">
                                <span id="website_error" style="color:red;"></span>
                            </div>
                            <!-- service time -->
                            <div class="form-group">
                                <label for="exampleSelectGender">Service Time</label>
                                <input type="time" class="form-control" id="service_time" placeholder="Service Time" name="service_time" value="{{$setting->service_time}}">
                                <span id="service_time_error" style="color:red;"></span>
                            </div>


                            <h4 class="card-title">Footer Content</h4>


                            <!-- linkedln -->
                            <div class="form-group">
                                <label for="exampleInputPassword">Linkedln Account</label>
                                <input type="text" class="form-control" id="linkedln" name="linkedln" placeholder="Linkedln Account" value="{{$setting->linkedln}}">
                                <span id="linkedln_error" style="color:red;"></span>
                            </div>
                            <!-- twitter -->
                            <div class="form-group">
                                <label for="exampleSelectGender">Twitter</label>
                                <input type="text" class="form-control" id="twitter" placeholder="Twitter Account" name="twitter" value="{{$setting->twitter}}">
                                <span id="twitter_error" style="color:red;"></span>

                            </div>
                            <!-- facebook -->
                            <div class="form-group">
                                <label for="exampleSelectGender">Facebook</label>
                                <input type="text" class="form-control" id="facebook" placeholder="Facebook Account" name="facebook" value="{{$setting->facebook}}">
                                <span id="facebook_error" style="color:red;"></span>

                            </div>

                            <button type="submit" class="btn btn-primary mr-2" id="updateSetting">Update</button>
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
    $(document).on("click", "#updateSetting", function(e) {
        e.preventDefault();
        var form = $("#settingForm");
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
                    url: "{{route('admin.update_setting')}}",
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