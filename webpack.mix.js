const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.styles([
    "resources/assets/css/main.css",
], "public/assets/css/styles.css");

mix.scripts([
    "resources/assets/js/jquery.js",
    "resources/assets/js/main.js",
], "public/assets/js/scripts.js");
