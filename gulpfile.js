var themename = 'PDQ';
var gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync  = require('browser-sync').create(),
    reload  = browserSync.reload,
    sass  = require('gulp-sass'),
    cleanCSS  = require('gulp-clean-css'),
    sourcemaps  = require('gulp-sourcemaps'),
    concat  = require('gulp-concat'),
    imagemin  = require('gulp-imagemin'),
    changed = require('gulp-changed'),
    uglify  = require('gulp-uglify'),
    lineec  = require('gulp-line-ending-corrector');

var root  = '../' + themename + '/',
    sass  = root + 'sass/',
    js  = root + 'js/',
    jsdist  = root + 'assets/js/';

  // Watch Files
var PHPWatchFiles  = root + '**/*.php',
    styleWatchFiles  = root + '**/*.sass';

  // Used to concat the files in a specific order.
var jsSRC = [
    js + 'bootstrap.bundle.js',
    js + 'bootstrap-hover.js',
    js + 'nav-scroll.js',
    js + 'prism.js',
    js + 'resizeSensor.js',
    js + 'sticky-sidebar.js',
    js + 'sticky-sb.js',
    js + 'skip-link-focus-fix.js'
];

  // Used to concat the files in a specific order.
var cssSRC = [
  root + 'src/css/bootstrap.css',
  root + 'src/css/all.css',
  root + 'src/css/prism.css',
  root + 'pdq.css',
];

var imgSRC = root + 'images/*',
    imgDEST = root + 'assets/images/';

function css() {
  return gulp.src([scss + 'pdq.sass'])
  .pipe(sourcemaps.init({loadMaps: true}))
  .pipe(sass({
    outputStyle: 'expanded'
  }).on('error', sass.logError))
  .pipe(autoprefixer('last 2 versions'))
  .pipe(sourcemaps.write())
  .pipe(lineec())
  .pipe(gulp.dest(root));
}

function concatCSS() {
  return gulp.src(cssSRC)
  .pipe(sourcemaps.init({loadMaps: true, largeFile: true}))
  .pipe(concat('pdq.css'))
  .pipe(cleanCSS())
  .pipe(sourcemaps.write('./maps/'))
  .pipe(lineec())
  .pipe(gulp.dest(sass));
}

function javascript() {
  return gulp.src(jsSRC)
  .pipe(concat('pdq.js'))
  .pipe(uglify())
  .pipe(lineec())
  .pipe(gulp.dest(jsdist));
}

function imgmin() {
  return gulp.src(imgSRC)
  .pipe(changed(imgDEST))
      .pipe( imagemin([
        imagemin.gifsicle({interlaced: true}),
        imagemin.jpegtran({progressive: true}),
        imagemin.optipng({optimizationLevel: 5})
      ]))
      .pipe( gulp.dest(imgDEST));
}

function watch() {
  browserSync.init({
    open: 'external',
    proxy: 'http://localhost:8888/pdq',
    port: 80,
  });
  gulp.watch(styleWatchFiles, gulp.series([css, concatCSS]));
  gulp.watch(jsSRC, javascript);
  gulp.watch(imgSRC, imgmin);
  gulp.watch([PHPWatchFiles, jsdist + 'pdq.js', scss + 'pdq.min.css']).on('change', browserSync.reload);
}

exports.css = css;
exports.concatCSS = concatCSS;
exports.javascript = javascript;
exports.watch = watch;
exports.imgmin = imgmin;

var build = gulp.parallel(watch);
gulp.task('default', build);
