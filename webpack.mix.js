const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/bootstrap.scss", "public/css")
    .sourceMaps();

mix.styles([
    "resources/assets/css/app.css",
    "resources/assets/css/tokenize2.min.css"
], "public/assets/css/layout.css");

mix.styles([
    "resources/assets/css/app.css",
    "resources/assets/css/tokenize2.min.css"
], "public/assets/css/styles.css");

mix.styles(
    ["resources/assets/css/tokenize2.min.css"],
    "public/assets/css/styles.css"
);

mix.styles(["resources/css/app.css"], "public/css/app.css").sourceMaps();
mix.styles(
    [
        "resources/assets/css/bootstrap-grid.min.css",
        "resources/assets/css/main.css",    ],
    "public/assets/css/main.css"
).sourceMaps();

mix.scripts(
    [
        "resources/assets/js/jquery.js",
        "resources/assets/js/tokenize2.min.js",
        "resources/assets/js/main.js",
    ],
    "public/assets/js/scripts.js"
);

mix.scripts(["resources/assets/js/webpush.js"], "public/assets/js/webpush.js");
mix.scripts(["resources/assets/js/style.js"], "public/assets/js/style.js");
