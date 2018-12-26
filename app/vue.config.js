module.exports = {
    chainWebpack: config => {
        config.module.rules.delete('eslint')
        if (config.plugins.has('extract-css')) {
            const extractCSSPlugin = config.plugin('extract-css')
            extractCSSPlugin && extractCSSPlugin.tap(() => [{
                filename: '[name].css',
                chunkFilename: '[name].css'
            }])
        }
    },
    configureWebpack: {
        output: {
            filename: '[name].js',
            chunkFilename: '[name].js'
        }
    },
    devServer: {
        // Enables us to serve the wp site from MAMP server and the vue app from a different port without getting CORB's warnings.
        disableHostCheck: true
    }
}