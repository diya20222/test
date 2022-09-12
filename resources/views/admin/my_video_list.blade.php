@extends('admin.master')
@section('title', 'Admin | Video List')
@section('main')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="form-group">
            <a href="video-upload"><button type="button" class="btn btn-primary ">Upload Video</button></a>
        </div>
        <div class="form-group">
            @include('error')
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="put-videodiv"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

{!!$dataTable->scripts()!!}

<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).on("click", ".showMediaVideo", function() {
        $("#put-videodiv").html('');
        d = new Date();

        var video = $(this).data("video");
        $("#myModal").modal("show");

        $("#put-videodiv").html('<video width="460" id="put-video" height="340" controls><source src="' + video + '?' + d.getTime() + '" type="video/mp4"></video>');

    });
    $(document).on('click', '#deleteRecord', function() {
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
                    url: 'destroy/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data) {
                            window.LaravelDataTables["video-table"].draw();
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
@endpush