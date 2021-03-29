module.exports = {
  corePlugins: {
    preflight: true,
  },
  important: true,
  purge: {
    enabled: true,
    content: [
      './resources/js/*.{js,vue}',
      './resources/js/**/*.{js,vue}',
      './resources/sass/*.scss',
      './resources/sass/**/*.scss',
      './*.php',
      './**/*.php',
    ]
  },
  darkMode: false,
  theme: {
    fontFamily: {
      'sans': ['Nunito', 'sans-serif',],
      'serif': ['Nunito', 'sans-serif',],
      'mono': ['Nunito', 'sans-serif',],
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
    extend: {
      colors: {
        maroon: {
          '50':  '#fcf8f7',
          '100': '#fdeef0',
          '200': '#fbd1e0',
          '300': '#faaac5',
          '400': '#fb7398',
          '500': '#fb486d',
          '600': '#f62b4b',
          '700': '#dc3545',
          '800': '#b11b34',
          '900': '#8d172b',
        },
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('tailwindcss-debug-screens'),
  ],
};
