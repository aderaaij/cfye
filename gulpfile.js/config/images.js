const config = require('./');

module.exports = {
    source: `${config.sourceAssets}img/**/*`,
    dest: `${config.themeAssets}img/`,
    imagemin: {
        optimizationLevel: 3,
        progressive: true,
        interlaced: true,
    },
};
