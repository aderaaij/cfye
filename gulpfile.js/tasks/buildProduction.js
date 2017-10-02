const gulp = require('gulp');
const plugins = require('gulp-load-plugins')();

const buildProduction = (cb) => {
    plugins.sequence(
        'clean',
        'composer',
        [
            'images',
            'svg:sprite',
        ],
        [
            'styles:production',
            'webpack:production',
        ],
        cb,
    );
};

gulp.task('build:production', buildProduction);
module.exports = buildProduction;
