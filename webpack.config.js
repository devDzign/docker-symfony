var Encore = require('@symfony/webpack-encore');


if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore

    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel(() => {
    }, {
        useBuiltIns: 'usage',
        corejs: 3
    })
    .addEntry('js/feedback', './assets/feedback/index.js')
    .enableVueLoader(() => {
    }, {
        useJsx: true
    })

;

module.exports = Encore.getWebpackConfig();
