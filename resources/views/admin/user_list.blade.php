@extends('admin.master')
@section('title', 'Admin | User List')
@section('main')

<div class="main-panel">
    <div class="content-wrapper">
        <div>
            @include('error')
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                </div>
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
    $(document).on('click', '#deleteUserRecord', function() {
        var id = $(this).attr('user_id');
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
                    url: 'delete-user/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data) {
                            window.LaravelDataTables["user-table"].draw();
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
@endpush