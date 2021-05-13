const { js } = require('laravel-mix');
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
    .js('resources/js/dashboard/dashboard.js', 'public/js/dashboard/')
    .copy('resources/template/dashboard/js/jquery.dataTables.min.js', 'public/js/dashboard/')
    .copy('resources/template/dashboard/js/dataTables.bootstrap5.min.js', 'public/js/dashboard/')
    .copy('resources/template/dashboard/js/responsive.bootstrap4.min.js', 'public/js/dashboard/')
    .copy('resources/template/dashboard/css/dataTables.bootstrap5.min.css', 'public/css/dashboard/')
    .copy('resources/template/dashboard/css/responsive.bootstrap.min.css', 'public/css/dashboard/')
    .sass('resources/sass/dashboard/dashboard.scss', 'public/css/dashboard/')
    .sourceMaps();