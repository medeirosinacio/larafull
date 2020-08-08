<?php


namespace App\Providers;

use App\Custom\BlueprintCustom;
use App\Custom\DatabaseFieldsNames;
use App\Custom\RequestCustom;
use App\Custom\ResponseCustom;
use App\Custom\StringableCustom;
use Illuminate\Support\ServiceProvider;

/**
 * Class MacroServiceProvider
 * Provider responsavel por aplicar comportamentos adicionais as classes padrão do laravel (Macro)
 * @link https://tighten.co/blog/the-magic-of-laravel-macros/
 * @link https://laravel.com/docs/6.x/responses#response-macros
 * @package App\Providers
 */
class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BlueprintCustom::register();
        RequestCustom::register();
        DatabaseFieldsNames::register();
        ResponseCustom::register();
        StringableCustom::register();
    }
}
