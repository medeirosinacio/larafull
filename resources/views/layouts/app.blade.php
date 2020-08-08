@extends('adminlte::page')

@hasSection('title')
    @section('title_postfix', ' - ' . env('APP_NAME'))
@endif

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif


@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark title-page">
                @hasSection('title_icon')
                    <i class="@yield('title_icon')"></i>
                @endif
                @yield('title')
                <small>@yield('subtitle')</small>
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset("painel/css/style.css") }}">
    @stack('stylesheet')
@stop

@section('js')
    <script src="{{ asset("painel/js/script.js") }}"></script>
    @stack('scripts')
    {!! Notifier::show() !!}
@endsection


