var gulp = require('gulp');
// Requires the gulp-sass plugin
var sass = require('gulp-sass');
//var browserSync = require('browser-sync').create();
/*
var uglify = require('gulp-uglify');
var gulpIf = require('gulp-if');
*/


gulp.task('sass', function(){
  return gulp.src('sass/styles.scss')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest('../dev-template/css'))

});

gulp.task('watch', ['sass'], function(){
  gulp.watch('sass/styles.scss', ['sass']); 
  // Other watchers
});
