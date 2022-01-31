
var config = require('./config.json');
var browserSync = require("browser-sync").create();

browserSync.init({
  files: [
    'style.css',
    'assets/**/*.css',
    'assets/**/*.js',
    '**/*.php'
  ],
  proxy: config.proxy
});
