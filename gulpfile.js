/* jshint esversion: 6 */

var gulp = require('gulp');
const { series, parallel } = require('gulp');
var config = require('./node_scripts/config.json');
var browserSync = require("browser-sync").create();
var concat = require('gulp-concat');
var imagemin = require('gulp-imagemin');
var cleanCss = require('gulp-clean-css');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

/**
 * Initialize
 */
function init(done) {
  require('./node_scripts/init.js');
  done();
}

/**
 * Build theme
 */
function build(done) {
  require('./node_scripts/build.js');
  done();
}

/**
 * Copy theme to a location
 */
function copy(done) {
  require('./node_scripts/copy.js');
  done();
}

/**
 * Browser reload on changes
 */
function browser_sync() {
  browserSync.init({
    files: [
      'style.css',
      'assets/**/*.css', 
      'assets/**/*.js',
      '**/*.php'
    ],
    proxy: config.proxy
  });
}

/**
 * Concat JS files
 */
function concat_js() {
  return gulp.src(config.concat_js)
  .pipe(concat('main.js'))
  .pipe(gulp.dest('assets/js/'));
}

/**
 * Minify JS files
 */
function min_js() {
  return gulp.src(config.min_js)
  .pipe(uglify())
  .pipe(rename({
    suffix: '.min'
  }))
  .pipe(gulp.dest('assets/js/'));
}

/**
 * Concat CSS files
 */
function concat_css() {
  return gulp.src(config.concat_css)
  .pipe(concat('main.css'))
  .pipe(gulp.dest('assets/css/'));
}

/**
 * Minify CSS files
 */
function min_css() {
  return gulp.src(config.min_css)
  .pipe(cleanCss())
  .pipe(rename({
    suffix: '.min'
  }))
  .pipe(gulp.dest('assets/css/'));
}

/**
 * Minify images
 */
function image_min() {
  return gulp.src('assets_dev/img/**/*')
  .pipe(imagemin())
  .pipe(gulp.dest('assets/img/'));
}

exports.init = init;
exports.build = build;
exports.copy = copy;
exports.css = series(concat_css, min_css);
exports.js = series(concat_js, min_js);
exports.img = image_min;

exports.default = function() {
  gulp.watch(config.concat_css, series(concat_css, min_css));
  gulp.watch(config.concat_js, series(concat_js, min_js));
  gulp.watch('assets_dev/img/*', image_min);
  browser_sync();
};
