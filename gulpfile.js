/*----------------------
Gulp Plugins
----------------------*/

var gulp         = require('gulp');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cssmin       = require('gulp-cssmin');
var rename       = require('gulp-rename');
var babel        = require('gulp-babel');
var watch        = require('gulp-watch');
var uglify       = require('gulp-uglify');
var notify       = require('gulp-notify');
var concat       = require('gulp-concat');

/*----------------------
Style Tasks
----------------------*/

// Custom styles written in scss
// Sass -> Autoprefix -> Minify

gulp.task('custom_styles', function () {
  gulp.src('./styles/scss/**/*.scss')
  .pipe(sass().on('error', notify.onError("Error: <%= error.message %>")))
  .pipe(autoprefixer({ browsers: ['iOS >= 7','last 2 versions'] }))
  .pipe(cssmin())
  .pipe(rename( {suffix: '.min'} ))
  .pipe(gulp.dest('./styles'))
});

// Plugin styles
// Concat -> Minify

gulp.task('plugin_styles', function () {
  gulp.src('./styles/plugins/**/*.css')
  .pipe(concat('plugin_styles.css'))
  .pipe(cssmin())
  .pipe(rename( {suffix: '.min'} ))
  .pipe(gulp.dest('./styles'))
});

/*----------------------
Javascript Tasks
----------------------*/

// Custom scripts
// Babel -> Concat -> Minify

gulp.task('custom_scripts', function(){
  gulp.src([
    './scripts/custom/global.js',
    './scripts/custom/**/!(global)*.js', // all files that end in .js EXCEPT global*.js
  ])
  .pipe(babel({presets: ['es2015']}).on('error', notify.onError("Error: <%= error.message %>")))
  .pipe(concat('custom_scripts.js'))
  .pipe(uglify().on('error', notify.onError("Error: <%= error.cause %>")))
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('./scripts'))
});

// Plugin Scripts
// Concat -> Minify

gulp.task('plugin_scripts', function(){
  gulp.src('./scripts/plugins/**/*.js')
  .pipe(concat('plugin_scripts.js'))
  .pipe(uglify())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('./scripts'))
});

/*----------------------
Watch Tasks
----------------------*/

gulp.task('watch', function() {

  gulp.watch('./styles/scss/**/*.scss', ['custom_styles']);

  gulp.watch('./styles/plugins/**/*.css', ['plugin_styles']);

  gulp.watch('./scripts/custom/*.js', ['custom_scripts']);

  gulp.watch('./scripts/plugins/*.js', ['plugin_scripts']);

});

gulp.task('default', ['watch']);