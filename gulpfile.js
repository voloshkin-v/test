const gulp = require("gulp");
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

// compile scss to css
function style() {
	return gulp.src('assets/scss/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('.'))
		.pipe(browserSync.stream());
}

// watch changes
function watch() {
	browserSync.init({
		proxy: 'http://test/',
		host: 'test',
		open: 'external'
	});

	gulp.watch('assets/scss/**/*.scss', style);
	gulp.watch('*.php').on('change', browserSync.reload);
	gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}

exports.style = style;
exports.watch = watch;
exports.default = gulp.series(watch);