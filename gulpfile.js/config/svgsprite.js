const config = require('./');

module.exports = {
    source: `${config.sourceAssets}sprite/**/*.svg`,
    dest: `${config.themeAssets}img/`,
};
