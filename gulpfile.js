var gulp = require('gulp');
var wpPot = require('gulp-wp-pot');

gulp.task('wppot', function () {
    return gulp.src('*.php')
        .pipe(wpPot( {
            domain: 'dez-starter',
            package: 'DezStarter Wordpress theme'
        } ))
        .pipe(gulp.dest('languages/dez-starter.pot'));
});
