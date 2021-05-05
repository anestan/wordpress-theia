const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.options({
  processCssUrls: false,
  postCss: [
    require('tailwindcss'),
    require('autoprefixer'),
  ],
});

mix.webpackConfig({
  devtool: 'source-map',
});

mix.browserSync({
  proxy: 'wordpress-theia.test',
  files: [
    'resources/js/*.{js,vue}',
    'resources/js/**/*.{js,vue}',
    'resources/sass/*.scss',
    'resources/sass/**/*.scss',
    '*.php',
    '**/*.php',
  ],
});

mix.setPublicPath('/');

mix.sass('resources/sass/style.scss', 'style.css');
mix.sass('resources/sass/app.scss', 'public/css/app.css');
mix.js('resources/js/app.js', 'public/js/app.js').vue();

mix.sass('resources/sass/meet-the-freds.scss', 'public/css/meet-the-freds.css');
mix.js('resources/js/meet-the-freds.js', 'public/js/meet-the-freds.js');

mix.sass('resources/sass/creative-process.scss', 'public/css/creative-process.css');
mix.js('resources/js/creative-process.js', 'public/js/creative-process.js');

mix.sass('resources/sass/position-parameter-visualiser.scss', 'public/css/position-parameter-visualiser.css');
mix.js('resources/js/position-parameter-visualiser.js', 'public/js/position-parameter-visualiser.js');


if (mix.inProduction()) {
  mix.version();
}
