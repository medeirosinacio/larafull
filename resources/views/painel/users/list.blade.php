@extends('layouts.app')

@section('title', 'Lista de usuários')
@section('title_icon', 'fas fa-users')

@section('content')

    @component('layouts.partials.card')

        @slot('content')

            <table class="table table-striped">
                <thead>
                <th>Username</th>
                <th>first_name</th>
                <th>last_name</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ Html::link($user->getUrl(), $user->username) }} </td>
                        <td>{{$user->first_name}} </td>
                        <td>{{$user->last_name}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endslot

    @endcomponent

@stop
