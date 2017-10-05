const gulp = require('gulp');
const plugins = require('gulp-load-plugins')();
const config = require('../config/styles');
const errorHandler = require('../lib/errorHandler');

const stylesProduction = () => gulp.src(config.source)

    .pipe(plugins.sass(config.settings))

    .on('error', errorHandler)

    .pipe(plugins.autoprefixer(config.autoprefixer))

    .pipe(plugins.cleanCss({ compatibility: 'ie8' }))

    .pipe(gulp.dest(config.dest));

gulp.task('styles:production', stylesProduction);
module.exports = stylesProduction;
