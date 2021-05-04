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

// mix.browserSync({
//   proxy: 'wordpress-theia.test',
//   files: [
//     'resources/js/*.{js,vue}',
//     'resources/js/**/*.{js,vue}',
//     'resources/sass/*.scss',
//     'resources/sass/**/*.scss',
//     '*.php',
//     '**/*.php',
//   ],
// });

mix.setPublicPath('/');

mix.sass('resources/sass/style.scss', 'style.css');
mix.sass('resources/sass/app.scss', 'public/css/app.css');
mix.js('resources/js/app.js', 'public/js/app.js').vue();

if (mix.inProduction()) {
  mix.version();
}
