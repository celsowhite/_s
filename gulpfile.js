/*=== Gulp Plugins ===*/

var gulp         = require('gulp');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cssmin       = require('gulp-cssmin');
var rename       = require('gulp-rename');
var watch        = require('gulp-watch');
var uglify       = require('gulp-uglify');
var gutil        = require('gulp-util');

/*=== Sass -> Prefix -> Minify ===*/

gulp.task('styles', function () {

    gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ browsers: ['last 3 versions'] }))
    .pipe(cssmin())
    .pipe(rename( {suffix: '.min'} ))
    .pipe(gulp.dest('./css'))

});

/*=== Javascript Minify ===*/

gulp.task('js-minify', function(){

  gulp.src('./js/scripts.js')
  .pipe(uglify().on('error', gutil.log))
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('./js'))

});

/*=== Watch Styles & Scripts ===*/

gulp.task('watch', function() {

    gulp.watch('./scss/**/*.scss', ['styles']);

    gulp.watch('./js/scripts.js', ['js-minify']);

});

/*=== Default Gulp task run watch ===*/

gulp.task('default', ['watch']);