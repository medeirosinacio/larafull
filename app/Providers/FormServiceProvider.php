<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    private $templatePath = 'layouts.laravelcollective';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Register the form components
        $this->createComponent('submitField', 'form.submit-field', ['name', 'options' => []]);

        $this->createComponent('textField', 'form.input-field',
            ['name', 'model', 'options' => [], 'input' => 'text']);

        $this->createComponent('passwordField', 'form.input-field',
            ['name', 'model', 'options' => [], 'input' => 'password']);


        $this->createComponent('ajaxOpen', 'form.open-ajax', ['model']);

        Form::component('bsTextArea', 'components.form.textarea', ['name', 'model', 'options' => []]);
        Form::component('bsSubmit', 'components.form.submit', ['value' => 'Submit', 'attributes' => []]);
        Form::component('hidden', 'components.form.hidden', ['name', 'value' => null, 'attributes' => []]);

    }

    private function createComponent($name, $layout, $options = ['name', 'model', 'options' => []])
    {
        Form::component($name, "{$this->templatePath}.{$layout}", $options);
    }

    private function createField($name, $closure)
    {
        Form::macro($name, $closure);
    }
}
