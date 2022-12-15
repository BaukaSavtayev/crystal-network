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

mix.js('resources/js/main.js', 'public/js')
    .vue()
    .sass('resources/scss/common.scss', 'public/css')
    .sass('resources/scss/style.scss', 'public/css')
    .styles([
        'public/css/common.css',
        'public/css/style.css',
        'resources/css/normalize.css',
    ], 'public/css/main.css')
    .browserSync('http://crystal.loc')
;
