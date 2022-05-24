/**
 * Gulp configuration.
 *
 * @package WordPress
 *
 * You should only need to change browsersync URL and project folder values to get running.
 */

// URL that will be used for hot reloading via Browser Sync.
// This should match with the prxoy setting in your.lando.yml file.
var BROWSERSYNC_URL = 'https://bs.lfph.lndo.site';

// Project folder related to gulpfile position.
const PROJECT_FOLDER = '.';

/**
 * File and folder links
 */
var styleSRC         = PROJECT_FOLDER + "/source/scss/*.scss";
var styleDestination = PROJECT_FOLDER + "/build/";

var jsGlobalSRC         = PROJECT_FOLDER + "/source/js/global/*.js";
var jsGlobalDestination = PROJECT_FOLDER + "/build/";
var jsGlobalFile        = "global";

var jsBlocksSRC         = PROJECT_FOLDER + "/source/js/blocks/*.js";
var jsBlocksDestination = PROJECT_FOLDER + "/build/";
var jsBlocksFile        = "blocks";

var styleWatchFiles        = PROJECT_FOLDER + "/source/scss/**/*.scss";
var thirdpartyJSWatchFiles = PROJECT_FOLDER + "/source/js/third-party/**/*.js";
var blocksJSWatchFiles     = PROJECT_FOLDER + "/source/js/blocks/**/*.js";
var globalJSWatchFiles     = PROJECT_FOLDER + "/source/js/global/**/*.js";
var projectPHPWatchFiles   = PROJECT_FOLDER + "/**/**/*.php";
var projectHTMLWatchFiles  = PROJECT_FOLDER + "/**/**/*.html";

/**
 * Load Plugins.
 *
 * Load gulp plugins and pass them semantic names.
 */
	var gulp = require( "gulp" ),

	/** CSS plugins */
	sass         = require( 'gulp-sass' )( require( 'sass' ) ),
	mmq          = require( 'gulp-merge-media-queries' ),
	cssnano      = require( 'cssnano' ),
	plumber      = require( 'gulp-plumber' ),
	autoprefixer = require( 'autoprefixer' ),
	postcss      = require( 'gulp-postcss' ),

	/** JS plugins */
	concat  = require( 'gulp-concat' ),
	terser  = require( 'gulp-terser' ),

	/** Utility plugins */
	lineec     = require( 'gulp-line-ending-corrector' ),
	sourcemaps = require( 'gulp-sourcemaps' ),
	touch      = require( 'gulp-touch-cmd' ),
	notify     = require( 'gulp-notify' ),
	rename     = require( 'gulp-rename' ),
	filter     = require( 'gulp-filter' ),

	browserSync = require( 'browser-sync' ).create();

/**
 * Error handler
 */
 function errorHandler(err) {
	console.error( err.toString() );
}

/**
 * BrowserSync Reload.
 */
function reload( callback ) {
	browserSync.reload();
	callback();
}

/**
 * BrowserSync Task
 */
function watch() {
	gulp.watch( projectPHPWatchFiles,reload );
	gulp.watch( projectHTMLWatchFiles ).on( "change",reload );
	gulp.watch( styleWatchFiles,gulp.series( [styles] ) );
	gulp.watch( thirdpartyJSWatchFiles,gulp.series( [reload] ) );
	gulp.watch( blocksJSWatchFiles,gulp.series( [blocksJS,reload] ) );
	gulp.watch( globalJSWatchFiles,gulp.series( [globalJS,reload] ) );

	return browserSync.init(
		{
			proxy: 'http://appserver_nginx',
			socket: {
				domain: BROWSERSYNC_URL,
				port: 80 // NOT the 3000 you might expect.
			},
			open: false,
			logLevel: "debug",
			logConnections: true,
		}
	);
}

/**
 * SASS to CSS tasks
 */
function styles() {
	return gulp
	.src( styleSRC )
	.pipe( plumber( {errorHandler: notify.onError( 'Error: <%= error.message %>' )} ) )
	.pipe( sourcemaps.init() )
	.pipe(
		sass(
			{
				indentType: "tab",
				indentWidth: 1,
				errLogToConsole: true,
				outputStyle: 'expanded',
				precision: 10
			}
		)
	)
	.pipe(
		sourcemaps.write(
			{
				includeContent: false
			}
		)
	)
	.pipe(
		sourcemaps.init(
			{
				loadMaps: true
			}
		)
	)
	.pipe(
		postcss(
			[
			autoprefixer(
				{
					cascade: false
				}
			)
			]
		)
	)
	.pipe( sourcemaps.write() )
	.pipe( lineec() )
	.pipe( gulp.dest( styleDestination ) )
	.pipe( filter( "**/*.css" ) )
	.pipe(
		mmq(
			{
				log: false
			}
		)
	)
	.pipe( browserSync.stream() )
	.pipe(
		rename(
			{
				suffix: ".min"
			}
		)
	)
	.pipe(
		sass(
			{
				errLogToConsole: true,
				outputStyle: "compressed",
				precision: 10
			}
		)
	)
	.pipe(
		postcss(
			[
			autoprefixer(
				{
					cascade: false
				}
			),
			cssnano
			]
		)
	)
	.pipe( lineec() )
	.pipe( plumber.stop() )
	.pipe( gulp.dest( styleDestination ) )
	.pipe( filter( "**/*.css" ) )
	.pipe( browserSync.stream() )
	.pipe( touch() );
}

/**
 * Global JS files
 */
function globalJS() {
	return gulp
	.src( jsGlobalSRC )
	.on('error', console.log)
	.pipe( concat( jsGlobalFile + '.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsGlobalDestination ) )
	.pipe(
		rename(
			{
				basename: jsGlobalFile,
				suffix: ".min"
			}
		)
	)
	.pipe( terser() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsGlobalDestination ) )
	.pipe( touch() );
}

/**
 * Blocks JS files
 */
function blocksJS() {
	return (
	gulp
	.src( jsBlocksSRC )
	.pipe( concat( jsBlocksFile + ".js" ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsBlocksDestination ) )
	.pipe(
		rename(
			{
				basename: jsBlocksFile,
				suffix: ".min"
			}
		)
	)
	.pipe( terser() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsBlocksDestination ) )
	.pipe( touch() )
	);
}

exports.default = gulp.series( styles,globalJS,blocksJS,watch );
exports.build   = gulp.series( styles,globalJS,blocksJS );
exports.watch   = gulp.series( watch );
