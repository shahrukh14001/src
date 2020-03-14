@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
@stop

@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @can('super_admin')
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ \Auth::user()->count() }}</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ \App\Models\Document::count() }}</h3>

                                <p>Total Documents</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ \App\Models\Category::count() }}</h3>

                                <p>Total Category</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer" disabled="">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @else
                    <p>You are logged in!</p>
                @endcan
            </div>
        </div>
    </div>
@stop