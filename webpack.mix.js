let mix = require("laravel-mix");

let tailwindcss = require("tailwindcss");

require('laravel-mix-purgecss');

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

mix.js("resources/js/app.js", "public/js/app.js")
    .js("resources/js/admin.js", "public/js")
    .postCss('resources/css/print.css', 'public/css')
    .postCss('resources/css/printa4.css', 'public/css')
    .postCss('resources/css/print955.css', 'public/css')
    .postCss('resources/css/doc.css', 'public/css')
    .postCss('resources/css/doclandscape.css', 'public/css')
    .sass("resources/sass/app.sass", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    })

    .purgeCss({

        enabled: mix.inProduction(),
        folders: ['src', 'templates'],
        extensions: ['html', 'js', 'php', 'vue'],
    });
