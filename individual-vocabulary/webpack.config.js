var Encore = require('@symfony/webpack-encore');

Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    // will create public/build/app.js and public/build/app.css
    .createSharedEntry('layout', './assets/js/layout.js')
    .addEntry('auth', './assets/js/auth.js')
    .addEntry('dashboard', './assets/js/dashboard.js')

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()
    .enableVersioning()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    .enableVueLoader()

    .enableSassLoader()
    .enableLessLoader();


module.exports = Encore.getWebpackConfig();
