@extends('adminlte::page')

@section('title')
    @yield('page_title')
@stop

@section('content_header')
    @yield('header')
@stop

@section('content')
    @yield('body_content')
@stop

@section('css')
    <style>
        a[href="{{ url('register') }}"] {
            color: red;
        }
    </style>
    @yield('page_css')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        let java_script_baseUrl = '{{ \URL::to('/') }}';
        let _token = '{{ csrf_token() }}';
        const Shahrukh_Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @yield('page_js')
@stop