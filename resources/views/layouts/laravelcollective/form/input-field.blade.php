@component('layouts.laravelcollective.form.field')

    @slot('name', $name)
    @slot('model', $model)
    @slot('options', $options)

    @slot('input')

        @if($input == 'text')
            {{ Form::text($name, $model->$name, array_merge(['class' => 'form-control'], $options)) }}
        @endif

        @if($input == 'password')
            {{ Form::password($name, array_merge(['class' => 'form-control'], $options)) }}
        @endif

    @endslot

@endcomponent
