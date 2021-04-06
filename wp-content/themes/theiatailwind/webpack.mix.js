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
  proxy: 'theia.test',
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
mix.sass('resources/sass/app.scss', 'public/css/app.css').options({
  postCss: [
    require("@tailwindcss/jit"),
  ],
});
mix.js('resources/js/app.js', 'public/js/app.js');
mix.js('resources/js/carousels.js', 'public/js/carousels.js');
mix.js('resources/js/google-maps.js', 'public/js/google-maps.js');
mix.js('resources/js/contact-form.js', 'public/js/contact-form.js').vue();

if (mix.inProduction()) {
  mix.version();
}
