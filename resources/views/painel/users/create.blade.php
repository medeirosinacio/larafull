@extends('layouts.app')

@section('title', 'Cadastrar usuário')
@section('title_icon', 'fas fa-users-cog')

@component('layouts.partials.breadcrumb')

    @slot('breadcrumbs', [

        ['name' => 'Usuários', 'link' => '/painel/usuarios/listar'],
        ['name' => 'Cadastrar']

    ])

@endcomponent

@section('content')

    @component('layouts.partials.card')

        @slot('title', 'Dados para cadastro')

        @slot('content')

            {!! Form::ajaxOpen($user) !!}
            {!! Form::textField('username', $user) !!}
            {!! Form::textField('first_name', $user) !!}
            {!! Form::textField('last_name', $user) !!}
            {!! Form::textField('email', $user) !!}
            {!! Form::passwordField('password', $user) !!}
            {!! Form::passwordField('password_confirmation', $user) !!}
            {!! Form::submitField() !!}
            {!! Form::close() !!}

        @endslot

    @endcomponent

@stop
