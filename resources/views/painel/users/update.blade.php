@extends('layouts.app')

@section('title', 'Atualizar usuário')
@section('title_icon', 'fas fa-users-cog')

@section('content')

    @component('layouts.partials.card')

        @slot('title', 'Dados para atualização')

        @slot('content')

            {!! Form::ajaxOpen($user) !!}
            {!! Form::textField('username', $user) !!}
            {!! Form::textField('first_name', $user) !!}
            {!! Form::textField('last_name', $user) !!}
            {!! Form::textField('email', $user) !!}
            {!! Form::submitField('Salvar') !!}
            {!! Form::close() !!}

        @endslot

    @endcomponent

@stop
