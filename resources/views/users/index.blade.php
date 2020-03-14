@extends('layouts.app')

@section('page_title', 'Users')

@section('header')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group pull-right">
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Add user</button>
            </div>
        </div>
    </div>
@stop

@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">List of user</h3>
                </div>

                <div class="box-body">
                    <table id="users_table" class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </thead>

                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_js')
    <script>
        let user_table;
        user_table = $('#users_table').DataTable({
            "autoWidth": false,
            "searching": true,
            "serverSide": true,
            "ajax": {
                "url": '{{ route('users.list') }}',
                "type": "get",
                "dataType": "json",
            },
            "columns": [
                { data: "name" },
                { data: "email"  },
                { data: "mobile"  },
                { data: "role" },
                { data: "actions" },
            ],
            "columnDefs": [
                { "orderable": false, "targets": [3, 4], "sClass": "text-center td-wrap" }
            ]
        });

        $('[name="search-box"]').on('keyup change', function (e) {
            if(e.keyCode === 13) {
                documents_table.search($(this).val()).draw();
            }
        });

        function changeStatus(id, status) {
            let url = '{{ route('users.update', ':id') }}';
            url = url.replace(':id', id);
            swal.fire({
                icon                : 'success',
                title               : 'Are you sure!',
                text                : 'You will be able to change the user status',
                showConfirmButton   : true,
                showCancelButton    : true
            }).then( function (value) {
                if(value.value) {
                    $.post(url, {_token: _token, _method: 'PUT', status : status}, function (response) {
                        swal.fire({
                            toast               : true,
                            position            : 'top-end',
                            timer               : 3000,
                            icon                : response.status.response,
                            title               : response.status.message,
                            showConfirmButton   : false,
                        });
                        user_table.ajax.reload(null, false);
                    });
                }
            });
        }
    </script>
@stop