const mix = require('laravel-mix');


mix.babel(['resources/js/app.js'], 'public/js/app.js')
   .babel(['resources/js/admin.js'], 'public/js/admin.js')
   .sass('resources/sass/app.scss', 'public/css');


