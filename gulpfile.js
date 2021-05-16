// Initialize modules

// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const { src, dest, watch, series, parallel } = require('gulp');

// Lets define our paths
const paths = {
	rootPath: './',
	scssPath: 'src/scss/clever-marketing.scss',
};

// Import all our Gulp-related packages that we will use

// Sass/CSS processes
const bourbon = require('bourbon').includePaths; // https://www.npmjs.com/package/bourbon
const neat = require('bourbon-neat').includePaths; // https://www.npmjs.com/package/bourbon-neat
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const cssMinify = require('gulp-cssnano');
const sassLint = require('gulp-sass-lint');

// JavaScript processes
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const eslint = require('gulp-eslint');
// Images
const imagemin = require('gulp-imagemin');

// Utilities
const notify = require('gulp-notify');
const del = require('del');
const plumber = require('gulp-plumber');
const rename = require('gulp-rename');
const browserSync = require('browser-sync');
const replace = require('gulp-replace');
const zip = require('gulp-zip');

/*
 *  we’ve adding the cb() callback function, setting it as a parameter and then invoking it at the end of the function.
 *  Adding this will signal async completion, and should fix that error:
 *  “The following tasks did not complete… Did you forget to signal async completion?”
 */

/**
 * Error handling
 * https://www.npmjs.com/package/gulp-notify
 * @function
 */
function handleErrors(cb) {
	var args = Array.prototype.slice.call(arguments);

	notify
		.onError({
			title: 'Task Failed [<%= error.message %>',
			message: 'See console.',
			sound: 'Sosumi', // See: https://github.com/mikaelbr/node-notifier#all-notification-options-with-their-defaults
		})
		.apply(this, args);

	gutil.beep(); // Beep 'sosumi' again

	// Prevent the 'watch' task from stopping
	this.emit('end');
	cb();
}

/*
 * CSS Tasks
 */

/**
 * Sass linting.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
function runSassLint(cb) {
	src(['src/scss/**/*.scss'])
		.pipe(sassLint())
		.pipe(sassLint.format())
		.pipe(sassLint.failOnError());

	cb();
}

/**
 * Minify and optimize style.css.
 *
 * https://www.npmjs.com/package/gulp-cssnano
 * https://www.npmjs.com/package/gulp-plumber
 * https://www.npmjs.com/package/gulp-notify
 * https://www.npmjs.com/package/gulp-rename
 */
function runCssMinify(cb) {
	return (
		src('assets/css/clever-marketing.css')
			// Error handling
			.pipe(
				plumber({
					errorHandler: handleErrors,
				})
			)

			.pipe(
				cssMinify({
					safe: true, // Use safe optimizations.
				})
			)
			.pipe(rename('clever-marketing.min.css'))
			.pipe(dest('assets/css/'))
			.pipe(
				notify({
					message: 'Styles are built.',
				})
			)
	);

	cb();
}

/**
 * Compile Sass and run stylesheet through PostCSS.
 *
 * https://www.npmjs.com/package/gulp-sass
 * https://www.npmjs.com/package/gulp-postcss
 * https://www.npmjs.com/package/autoprefixer
 * https://www.npmjs.com/package/gulp-sourcemaps
 * https://www.npmjs.com/package/gulp-plumber
 */
function runPostCss(cb) {
	return (
		src(paths.scssPath)
			// Deal with errors.
			.pipe(
				plumber({
					errorHandler: handleErrors,
				})
			)

			// Wrap tasks in a sourcemap
			.pipe(sourcemaps.init())
			// Compile Sass
			.pipe(
				sass({
					includePaths: [].concat(bourbon, neat),
					errLogToConsole: true,
					outputStyle: 'expanded', // Options: nested, expanded, compact, compressed
				})
			)
			// Parse with PostCSS plugins.
			.pipe(
				postcss([
					autoprefixer(), // browserslist key added to package.json
				])
			)

			// create the sourcemap
			.pipe(sourcemaps.write())

			// Create style.css.
			.pipe(dest('assets/css/'))
			.pipe(browserSync.stream())
	);

	cb();
}

/**
 * Compress our images
 * https://www.npmjs.com/package/gulp-imagemin
 */
function images(cb) {
	src('assets/images/*')
		.pipe(
			imagemin([
				imagemin.gifsicle({ interlaced: true }),
				imagemin.mozjpeg({ quality: 75, progressive: true }),
				imagemin.optipng({ optimizationLevel: 5 }),
				imagemin.svgo({
					plugins: [{ removeViewBox: true }, { cleanupIDs: false }],
				}),
			])
		)
		.pipe(dest('dist/images'));
	// body omitted
	cb();
}

exports.clever = series(runPostCss, runCssMinify);
