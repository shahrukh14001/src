@extends('adminlte::login')

@section('adminlte_css')
    <style>
        a[href="{{ url('register') }}"] {
            display: none;
        }
    </style>
@stop