const mix = require('laravel-mix');
require('dotenv').config({path: './docker/.env'});

mix.config.fileLoaderDirs.fonts = 'assets/fonts';

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

var site_path = 'resources/views/site/';
var painel_path = 'resources/views/painel/';

var assets = 'public/assets/';
var site_assets = assets + 'site/';
var painel_assets = assets + 'painel/';

mix.setPublicPath('public/')

    // tempalte
    .js("resources/assets/" + process.env.APP_TEMPLATE + "/js/*.js", 'public/assets/template/js/app.js')
    .sass("resources/assets/" + process.env.APP_TEMPLATE + "/css/app.scss", 'public/assets/template/css/app.css')

    // Site assets
    .sass(
        site_path + 'css/login.scss', site_assets + 'css/style.css', {
            prependData: '$ASSET_URL:\'' + process.env.ASSET_URL + '\';'
        })
    .scripts([
        site_path + 'js/*.js'
    ], site_assets + 'js/script.js')

    // Painel assets
    .sass(
        painel_path + 'css/painel.scss', painel_assets + 'css/style.css', {
            prependData: '$ASSET_URL:\'' + process.env.ASSET_URL + '\';'
        })
    .scripts([
        painel_path + 'js/*.js'
    ], painel_assets + 'js/script.js')

    .version();

mix.setPublicPath('public/').copy('resources/images/', 'public/assets/images');
mix.setPublicPath('public/').copy('resources/favicons/', 'public/assets/favicons');
