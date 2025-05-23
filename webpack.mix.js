const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .css('resources/css/home.css', 'public/css') // Move this inside the same chain
    .css('resources/css/home/intro.css', 'public/css/home/intro.css') // Move this inside the same chain
    .css('resources/css/home/services.css', 'public/css/home/services.css') // Move this inside the same chain
    .css('resources/css/home/technologies.css', 'public/css/home/technologies.css') // Move this inside the same 
    .css('resources/css/home/our-process.css', 'public/css/home/our-process.css') // Move this inside the same chain
    .css('resources/css/home/pricing.css', 'public/css/home/pricing.css') // Move this inside the same chain
    .css('resources/css/navbar.css', 'public/css') // Move this inside the same chain
    .css('resources/css/terms_conditions.css', 'public/css') // Move this inside the same chain
    .css('resources/css/contact-us.css', 'public/css') // Move this inside the same chain
    .css('resources/css/footer.css', 'public/css') // Move this inside the same chain
    .js('resources/js/home.js', 'public/js') // Move this inside the same chain
    .js('resources/js/contactUsForm.js', 'public/js/contactUsForm.js') // Move this inside the same chain
    .browserSync({
        proxy: 'http://127.0.0.1:8000',
        files: [
            'app/**/*.php',
            'resources/views/**/*.blade.php',
            'public/js/**/*.js',
            'public/css/**/*.css',
            'routes/**/*.php'
        ],
        open: false,
        notify: false
    });



// old server

// const mix = require('laravel-mix');

// /*
//  |--------------------------------------------------------------------------
//  | Mix Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Mix provides a clean, fluent API for defining some Webpack build steps
//  | for your Laravel applications. By default, we are compiling the CSS
//  | file for the application as well as bundling up all the JS files.
//  |
//  */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
