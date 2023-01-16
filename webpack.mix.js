const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('public/')
    .js('resources/assets/admin/script/app.js', 'public/assets/admin/js')
    .extract(
        ['jquery', 'bootstrap']
    )
    .sass('resources/assets/admin/sass/app.scss', 'public/assets/admin/css')
    .options({
        processCssUrls: false
    });
    // .postCss('resources/css/app.css', 'public/asstes/admin/css', [
    //     //
    // ]);
