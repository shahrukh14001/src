@extends('layouts.app')

@section('title')
    Profile
@stop

@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update profile detail</h3>
                    </div>

                    <div class="box-body">
                        <img src="{{ asset('/img/comingsoon.png') }}" style="width: 100%">
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop