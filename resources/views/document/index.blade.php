@extends('layouts.app')

@section('page_title')
    Documents
@stop

@section('content_header')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group pull-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#create_document_modal"><i class="fa fa-plus"></i> Add Document</button>
            </div>
        </div>
    </div>
@stop

@section('body_content')
    @include('document.partials.documents_list')
    @include('document.partials.create_document_modal')
@stop

@section('page_css')
    <style>
        div#documents_table_filter {
            display: none;
        }
    </style>
@stop

@section('page_js')
    <script>
        let name, url, category_id = false, documents_table;

        documents_table = $('#documents_table').DataTable({
            "autoWidth": false,
            "searching": true,
            "serverSide": true,
            "ajax": {
                "url": '{{ route('documents.list') }}',
                "type": "get",
                "dataType": "json",
            },
            "columns": [
                { data: "name" },
                { data: "description" },
                { data: "url", "width" : "50px", "sClass" : "text-center" },
                { data: "status", "sClass": "text-center td-wrap", "width": "50px" },
                { data: "actions" },
            ],
            "columnDefs": [
                { "orderable": false, "targets": [2, 4], "sClass": "text-center td-wrap" }
            ]
        });

        $('[name="search-box"]').on('keyup change', function (e) {
            if(e.keyCode === 13) {
                documents_table.search($(this).val()).draw();
            }
        });

        $('#name').bind('input propertychange', function () {
            name = $(this).val().length > 0;
            enabledSubmit();
        });

        $('#documents_table').on('click', 'span.copy-url', function () {
            let element = $('<input type="text" value="'+$(this).attr('title')+'">');
            $(this).append(element);
            element.select();
            document.execCommand('copy');
            element.remove();
        });

        $('#url').bind('input propertychange', function () {
            url = $(this).val().length > 0;
            enabledSubmit();
        });

        $('#category_id').on('change', function () {
            category_id = $(this).val() > 0;
            enabledSubmit();
        });

        function enabledSubmit() {
            if ( name && url && category_id ) {
                $('#create_document').attr('disabled', false);
            } else {
                $('#create_document').attr('disabled', true);
            }
        }

        $('#create_document_form').submit( function (e) {
            e.preventDefault();
            let form = $(this)[0];
            let data = new FormData(form);
            $.ajax({
                url         : "{{ route('documents.store') }}",
                type        : "post",
                data        : data,
                contentType : false,
                processData : false,
                cache       : false,
                dataType    : "json",
                success     : function (response) {
                    Shahrukh_Toast.fire({
                        icon    : response.status.response,
                        title   : response.status.message
                    });
                    $('#create_document_modal').modal('hide').find('form').trigger('reset');
                    name = category_id = url = false;
                    documents_table.ajax.reload(null, false);
                    enabledSubmit();
                }
            });
        });

        $('#create_document_modal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });

        $('#documents_table').on('click', 'span.delete-document', function () {
            let url = '{{ route('documents.destroy', ':id') }}';
            url = url.replace(':id', $(this).attr('data-id'));
            swal.fire({
                icon                : 'warning',
                title               : 'Are you sure!',
                text                : 'You will not be able to recover this document',
                showConfirmButton   : true,
                confirmButtonText   : 'Yes Delete it',
                showCancelButton    : true,
            }).then( function (value) {
                if(value.value) {
                    $.ajax({
                        url     : url,
                        type    : 'delete',
                        data    : { _token: _token },
                        success : function (response) {
                            Shahrukh_Toast.fire({
                                icon        : response.status.response,
                                title       : response.status.message
                            });
                            documents_table.ajax.reload(null, false);
                        }
                    });
                }
            });
        });
    </script>
@stop