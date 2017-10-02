const gulp = require('gulp');
const styles = require('../config/styles');
const images = require('../config/images');
const svgSprite = require('../config/svgSprite');
const plugins = require('gulp-load-plugins')();

const watchTask = () => {
    plugins.watch(styles.base, () => { gulp.start('styles'); });
    plugins.watch(images.source, () => { gulp.start('images'); });
    plugins.watch(svgSprite.source, () => { gulp.start('svg:sprite'); });
};

gulp.task('watch', ['browserSync', 'setWatch', 'webpack:watch'], watchTask);
module.exports = watchTask;
