var gulp = require('gulp');
//compile less file
var less = require('gulp-less');
//minify css
var minifycss = require('gulp-minify-css');
//add prefixes for all browswers, for old ones as well
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');
/*
 |--------------------------------------------------------------------------
 | COMPILE LESS into CSS
 |--------------------------------------------------------------------------
 |
 | compile and minify CSS with autoprefixer
 | notify - very useful in case of errors
 |
 | task: gulp compile-less
 */

gulp.task('compile-less', function () {
    gulp.src('resources/less/app.less') // path to your file
    .pipe(less())
    .pipe(autoprefixer('last 20 version','ie 9'))
    .pipe(gulp.dest('public/css'));
});
/*
 |--------------------------------------------------------------------------
 | COMPILE LESS into MIN CSS
 |--------------------------------------------------------------------------
 |
 | compile and minify CSS with autoprefixer
 | notify - very useful in case of errors
 |
 | task: gulp compile-less-min
 */
gulp.task('compile-less-min', function () {
    gulp.src('resources/less/app.less') // path to your file
    .pipe(less())
    .pipe(autoprefixer('last 20 version','ie 9'))
	.pipe(minifycss())
    .pipe(gulp.dest('public/css/min'))
    .pipe(notify("Saved file: <%= file.relative %>!"));
});
