@extends('layouts.app')

@section('title', 'Perfil de usuário')
@section('title_icon', 'fas fa-users')

@section('content')

    @component('layouts.partials.card')

        @slot('header_buttons', [
            [
                'name' => 'Editar',
                'icon' => 'fas fa-pencil-alt',
                'url' => "painel/usuarios/{$user->id}/editar",
            ]]);

        @slot('content')

            <table class="table table-striped">
                <tbody>
                @foreach($user->getAttributes() as $key => $attribute)
                    <tr>
                        <td class="text-bold">{{ $user->getAttributeLabel($key) }}</td>
                        <td>{{$attribute}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endslot

    @endcomponent

@stop
