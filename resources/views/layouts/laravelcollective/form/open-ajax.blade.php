@php($formID =  Str::random(40))

{!! Form::open(array_merge(
    [
        'class' => 'form-row',
        'enctype' => 'multipart/form-data',
        'data-send-type' => 'ajax',
        'onsubmit'=> "return new AjaxRequest(\"{$formID}\").send() || false;",
        'id' => $formID,
    ],
    $options ??= []))
!!}
