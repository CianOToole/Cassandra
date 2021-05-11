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
    .js('resources/js/stock.js', 'public/js')
    .js('resources/js/search.js', 'public/js')
    .js('resources/js/balance.js', 'public/js')
    .js('resources/js/news.js', 'public/js')
    .js('resources/js/stockData.js', 'public/js')
    .js('resources/js/posts.js', 'public/js')
    .js('resources/js/forum.js', 'public/js')
    .js('resources/js/watchlist.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();