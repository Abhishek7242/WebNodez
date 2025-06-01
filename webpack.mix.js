const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .css('resources/css/home.css', 'public/css')
    .css('resources/css/home/intro.css', 'public/css/home/intro.css')
    .css('resources/css/services/intro.css', 'public/css/services/intro.css')
    .css('resources/css/services/our-services.css', 'public/css/services/our-services.css')
    .css('resources/css/services/our-process.css', 'public/css/services/our-process.css')
    .css('resources/css/services/contact-page.css', 'public/css/services/contact-page.css')
    .css('resources/css/home/services.css', 'public/css/home/services.css')
    .css('resources/css/home/technologies.css', 'public/css/home/technologies.css')
    .css('resources/css/home/our-process.css', 'public/css/home/our-process.css')
    .css('resources/css/home/pricing.css', 'public/css/home/pricing.css')
    .css('resources/css/home/portfolio.css', 'public/css/home/portfolio.css')
    .css('resources/css/home/why-us.css', 'public/css/home/why-us.css')
    .css('resources/css/about/culture.css', 'public/css/about/culture.css')
    .css('resources/css/portfolio/intro.css', 'public/css/portfolio/intro.css')
    .css('resources/css/service/intro.css', 'public/css/service/')
    .css('resources/css/service/service-overview.css', 'public/css/service/')
    .css('resources/css/service/technology.css', 'public/css/service/')
    .css('resources/css/components/why-choose-us.css', 'public/css/components/')
    .css('resources/css/portfolio/case-studies.css', 'public/css/portfolio/case-studies.css')
    .css('resources/css/portfolio/design-gallery.css', 'public/css/portfolio/design-gallery.css')
    .css('resources/css/portfolio/work-details.css', 'public/css/portfolio/work-details.css')
    .css('resources/css/portfolio/blogs.css', 'public/css/portfolio/blogs.css')
    .css('resources/css/navbar.css', 'public/css')
    .css('resources/css/terms_conditions.css', 'public/css')
    .css('resources/css/contact-us.css', 'public/css')
    .css('resources/css/blogs.css', 'public/css')
    .css('resources/css/footer.css', 'public/css')
    .css('resources/css/about.css', 'public/css')
    .css('resources/css/canvas-background.css', 'public/css')
    .css('resources/css/dark-mode.css', 'public/css')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/chatbot.js', 'public/js')
    .js('resources/js/about.js', 'public/js')
    .js('resources/js/contactUsForm.js', 'public/js/contactUsForm.js')
    .js('resources/js/services/intro.js', 'public/js/services/')
    .js('resources/js/canvas-background.js', 'public/js')
    .js('resources/js/dark-mode.js', 'public/js')
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
