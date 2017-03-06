var gulp =  require( 'gulp' );
var sass = require('gulp-sass');
var cssNano = require('gulp-cssnano');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var del = require('del');



gulp.task('default', ['clean:dist','sass','uglify','images','fonts']);

gulp.task( 'sass', function(){
	return gulp.src([
		'assets/styles/main.scss'
	])
    .pipe(sass())
    .pipe(cssNano())
    .pipe(gulp.dest('dist/css'));
});

gulp.task('uglify', function() {
	return gulp.src([
		'bower_components/jquery/dist/jquery.js',	
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/button.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/carousel.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/popover.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/scrollspy.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/tab.js',
		'bower_components/bootstrap-sass/assets/javascripts/bootstrap/affix.js',
		'bower_components/jquery-ui/jquery-ui.js',
		'bower_components/swipebox/lib/ios-orientationchange-fix.js',
		'bower_components/swiper/dist/js/swiper.js',
		'assets/vendor/*.js',
		'assets/js/**/*.js',
	])
	.pipe(concat('main.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('dist/js'));
});


gulp.task('images', function(){
	return gulp.src([
		'assets/images/**/*.+(png|jpg|jpeg|gif|svg)',
		'bower_components/swipebox/src/img/**/*.+(png|jpg|jpeg|gif|svg)'
	])
	.pipe(cache(imagemin({
		interlaced: true
	})))
	.pipe(gulp.dest('dist/images'));
});

gulp.task('fonts', function() {
	return gulp.src([
		'bower_components/bootstrap-sass/assets/fonts/bootstrap/**/*',
		'bower_components/jquery-ui-scss/assets/fonts/**/*',
		'assets/fonts/**/*'
	])
	.pipe(gulp.dest('dist/fonts'));
});

gulp.task('clean:dist', function() {
	return del.sync('dist');
})

gulp.task('watch', function(){
	gulp.watch('assets/styles/**/*.scss', ['sass']);
	gulp.watch('assets/js/**/*.js', ['uglify']);
});
