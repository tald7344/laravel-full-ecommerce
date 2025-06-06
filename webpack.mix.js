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
    .sass('public/design/style/scss/main.scss', 'public/design/style/css/custom')
    .sass('public/design/style/scss/main-rtl.scss', 'public/design/style/css/custom')
    .sass('public/design/style/scss/product.scss', 'public/design/style/css/custom')
    .sass('public/design/style/scss/loader.scss', 'public/design/style/css/custom')
    .sass('public/design/style/scss/cart.scss', 'public/design/style/css/custom')
    .sass('public/design/style/scss/profile.scss', 'public/design/style/css/custom');
    // .sass('resources/sass/app.scss', 'public/css');
