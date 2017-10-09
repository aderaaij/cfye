const config = require('./');

module.exports = {
    source: `${config.sourceAssets}img/sprite/**/*.svg`,
    dest: `${config.themeAssets}img/`,
};
