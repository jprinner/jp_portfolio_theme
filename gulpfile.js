var autoprefixer = require('gulp-autoprefixer');
var bump = require('gulp-wp-bump');
var cleanCss = require('gulp-clean-css');
var gulp = require('gulp');
var jshint = require('gulp-jshint');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var stylish = require('jshint-stylish');
var uglify = require('gulp-uglify');

gulp.task('scripts', function() {
    return gulp.src( './src/js/script.js' )
        .pipe( jshint() )
        .pipe( jshint.reporter(stylish) )
        .pipe( uglify() )
        .pipe( rename({ suffix: '.min' }) )
        .pipe( bump( './functions.php' ) )
        .pipe( gulp.dest( './assets/js/' ) );
});

gulp.task('styles', function() {
    return gulp.src( './src/styles/style.scss' )
    .pipe( sass() )
    .pipe( autoprefixer({
      browsers: ['last 5 versions', 'not ie < 11'],
      cascade: false
    }))
    .pipe( cleanCss({ compatibility: 'ie9' }) )
    .pipe( rename({ suffix: '.min' }) )
    .pipe( bump( './functions.php' ) )
    .pipe( gulp.dest( './assets/css/' ) );
});

gulp.task( 'default', ['watch'] );

gulp.task('watch', function() {
    gulp.watch(['./src/styles/*.scss'], ['styles']);
    gulp.watch(['./src/js/script.js'], ['scripts']);
});