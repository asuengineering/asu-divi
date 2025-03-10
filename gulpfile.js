const gulp = require('gulp');

const config = {
	// your config here
};

// Require GulpWP and pass your custom config
const gulpWP = require('gulp-wp')(gulp, config);


/**
 * Copy Assets from node_modules.
 * Run: gulp upboot

 * Does the following:
 * 1. Copies files from component-header to /src
 * 2. Copies files from component-footer to /src
 *
 */

gulp.task("upboot", function (done) {

	var paths = {
		"node": "./node_modules",
		"dev": "./src",
	};

	// Copy UDS component-header JS files
	gulp
		.src(paths.node + "/@asu/component-header/dist/**/*")
		.pipe(gulp.dest(paths.dev + "/uds-header/js"));

	// Copy UDS component-footer JS files
	gulp
		.src(paths.node + "/@asu/component-footer/dist/**/*")
		.pipe(gulp.dest(paths.dev + "/uds-footer/js"));

	done();
});

