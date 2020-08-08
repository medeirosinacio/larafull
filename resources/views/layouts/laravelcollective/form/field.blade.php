<div class="form-group field {!! $errors->has($name) ? 'has-error' : '' !!}  col-md-6 col-lg-3">
    {{ Form::label($name, method_exists($model, 'getAttributeLabel') ? $model->getAttributeLabel($name) : '', ['class' => 'control-label']) }}
    {!! $input ??= '' !!}
    <span class="help-block error invalid-feedback">
        {!! $errors->first($name, ':message') !!}
    </span>
</div>
