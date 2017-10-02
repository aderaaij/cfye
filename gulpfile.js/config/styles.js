const config = require('./');

module.exports = {
    autoprefixer: { browsers: ['last 2 versions'] },
    source: `${config.sourceAssets}sass/**/*.scss`,
    dest: `${config.themeAssets}css/`,
    base: `${config.sourceAssets}sass/**/*`,
    settings: {
        outputStyle: 'nested',
        includePaths: [
            './node_modules/normalize-scss/sass/',
            './node_modules/susy/sass/',
            './node_modules/breakpoint-sass/stylesheets/',
        ],
    },
};
