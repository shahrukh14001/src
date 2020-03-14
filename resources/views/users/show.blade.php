@extends('layouts.app')

@section('title')
    Edit user
@stop

@section('header')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i> Back to list</a>
            </div>
        </div>
    </div>
@stop

@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="box box-primary">
                    <form name="user_update_form" id="user_update_form">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                        <div class="box-header">
                            <h3 class="box-title">Edit user details</h3>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter user name" autocomplete="off" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="text" name="email" id="email" placeholder="Enter user email" autocomplete="off" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input class="form-control" type="text" name="mobile" id="mobile" placeholder="Enter user mobile" autocomplete="off" value="{{ $user->mobile }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <label for="status"></label>
                                        Active <input type="checkbox" name="status" id="status" {{ $user->status ? 'checked' : '' }}>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <button type="button" class="btn btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_js')
    <script>
        $( function () {
            $('#users_table').on('click', 'span.change-status', function () {
                console.log('click');
            });

            $('#user_update_form').submit( function (e) {
                e.preventDefault();
                let form = $(this)[0];
                let data = new FormData(form);
                $.ajax({
                    url         : '{{ route('users.update', $user->id) }}',
                    type        : 'post',
                    dataType    : 'json',
                    data        : data,
                    contentType : false,
                    processData : false,
                    cache       : false,
                    success     : function (response) {

                    }
                });
            });
        });
    </script>
@stop