/*=== Gulp Plugins ===*/

var gulp         = require('gulp');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss    = require('gulp-minify-css');
var rename       = require('gulp-rename');
var watch        = require('gulp-watch');
var browserSync  = "browser-sync": "^2.10.0",

/*=== Sass -> Prefix -> Minify ===*/

gulp.task('styles', function () {

    gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .on('error', function(err){
            browserSync.notify(err.message, 3000);
            this.emit('end');
    })
    .pipe(autoprefixer({ browsers: ['last 2 versions'] }))
    .pipe(minifycss())
    .pipe(rename( {suffix: '.min'} ))
    .pipe(gulp.dest('./css'))
    .pipe(browserSync.stream());

});

/*=== Start Server with BrowserSync and Watch Styles ===*/

gulp.task('watch', function() {

	browserSync.init({
		port: 8888,
	    proxy: "localhost:8888",
	});

  	gulp.watch('./scss/**/*.scss', ['styles']);

});

/*=== Default Gulp task run watch ===*/

gulp.task('default', ['watch']);