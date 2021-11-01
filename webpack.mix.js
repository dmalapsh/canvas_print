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

mix.js(['resources/js/app.js','resources/js/jquery.viewbox.min.js'], 'public/js')
   .sass('resources/sass/app.scss', 'public/css/app.css');
mix.browserSync({
    proxy: 'http://localhost:8080',
    notify: false
});
