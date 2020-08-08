@extends('adminlte::page')

@hasSection('title')
    @section('title_postfix', ' - ' . env('APP_NAME'))
@endif


@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark title-page">
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

@section('content')
    @include('layouts.partials.card', [
        'header' => true,
        'color' => 'info',
        'title' => 'title da box 3',
        'header_btn' => [
            [
                'name' => 'Editar',
                'icon' => 'fas fa-pencil-alt',
                'submenu' => [
                    [
                        'name' => 'Editar menu a',
                        'icon' => 'fas fa-pencil-alt',
                        'url' => 'painel/a'
                    ],
                    [
                        'name' => 'Editar menu',
                        'url' => 'painel/a'
                    ],
                ],
            ],
            [
                'name' => 'btn1',
                'icon' => 'fa fa-bell',
                'url' => 'painel/a'
            ],
            [
                'name' => 'btn2',
                'icon' => 'fa fa-bell',
                'url' => 'painel/a'
            ],
            [
                'name' => 'btn2',
                'icon' => 'fa fa-bell',
                'submenu' => [
                    [
                        'name' => 'btn2',
                        'icon' => 'fa fa-bell',
                        'url' => 'painel/a'
                    ],
                    [
                        'name' => 'btn2',
                        'icon' => 'fa fa-bell',
                        'url' => 'painel/a'
                    ],
                ],
            ],
                        [
                'name' => 'btdasdn2',
                'icon' => 'fa fa-bell',
                'submenu' => [
                    [
                        'name' => 'btna2',
                        'icon' => 'fa fa-bell',
                        'url' => 'painel/a'
                    ],
                    [
                        'name' => 'btnda2',
                        'icon' => 'fa fa-bell',
                        'url' => 'painel/a'
                    ],
                ],
            ],
                        [
                'name' => 'btdasdn2',
                'icon' => 'fa fa-bell',
                'submenu' => [
                    [
                        'name' => 'btna2',
                        'icon' => 'fa fa-bell',
                        'url' => 'painel/a'
                    ],
                    [
                        'name' => 'btnda2',
                        'icon' => 'fa fa-bell',
                        'url' => 'painel/a'
                    ],
                ],
            ],
        ],
    ])

    @include('layouts.partials.card', [
    'header' => true,
    'color' => 'success',
    'title' => 'title da box 2',

])
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset("painel/css/style.css") }}">
@stop

@section('js')
    <script src="{{ asset("painel/js/script.js") }}"></script>
@stop
