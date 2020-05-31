const mix = require('laravel-mix');



mix.js([
    'resources/js/app.js',
    'resources/js/assets//js/app.js'
    ], 'public/js',)
    .sass('resources/sass/app.sass', 'public/css')
    .sourceMaps();



mix.browserSync({
online: false,
proxy : 'http://127.0.0.1:8000/principiante-laravel/basico-dos/'
});
