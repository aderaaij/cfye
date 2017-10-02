const config = require('./');

module.exports = {
    source: [
        `${config.sourceAssets}js/vendor/*.js`,
        `${config.sourceAssets}js/partials/*.js`,
        `${config.sourceAssets}js/*.js`,
    ],
    entry: {
        // You can add multiple entries and include a destiotion path in the key
        // https://stackoverflow.com/a/45278943/4474075
        script: `${config.sourceAssets}js/script.js`,
    },
    base: `${config.sourceAssets}js`,
    dest: `${config.themeAssets}js`,
    extractSharedJs: true,
    concat: 'scripts.js',
    rename: {
        suffix: '.min',
    },
};
