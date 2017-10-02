const gulp = require('gulp');
const composer = require('gulp-composer');

const composerTask = () => composer();

gulp.task('composer', composerTask);
module.exports = composerTask;
