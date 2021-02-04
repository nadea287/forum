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
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/commerce.scss', 'public/css');
mix.copy('resources/js/main.js', 'public/js')
mix.copy('resources/js/session-message.js', 'public/js')
mix.copy('resources/js/stripe-menu.js', 'public/js')
mix.copy('resources/js/delete-item.js', 'public/js')
mix.copy('resources/js/data.js', 'public/js')
mix.copy('resources/js/comment.js', 'public/js')
mix.copy('resources/js/mark-solution.js', 'public/js')
mix.copy('resources/js/tag.js', 'public/js')
mix.copy('resources/js/checkout.js', 'public/js')
mix.copy('resources/js/cart.js', 'public/js')
