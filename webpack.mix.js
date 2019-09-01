let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss');

const purgecss = require('@fullhuman/postcss-purgecss')({

  // Specify the paths to all of the template files in your project 
  content: [
    './resources/**/*.html',
    './resources/**/*.vue',
    './resources/**/*.js',
    './resources/**/*.php'
  ],

  // Include any special characters you're using in this regular expression
  defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
})

mix.js('resources/js/tab.js', 'dist/js')
    .options({
        processCssUrls: false,
        postCss: [
        tailwindcss('./tailwind.config.js'),
        ...process.env.NODE_ENV === 'production' ? [purgecss] : []
        ],
    });
