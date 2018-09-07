const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
var WebpackNotifierPlugin = require('webpack-notifier');

module.exports = (env, argv) => {

  // Set Environment

  const devMode = argv.mode !== 'production'

  // Webpack Config

  return {
    // Index is the main entry point. Contains the full site styles and scripts.
    // Login is the entry point for the wp-login screen. Contains styles specific for the login page.
    entry: {
      main: './src/index.js',
      login: './src/login.js'
    },
    output: {
      filename: '[name].min.js',
      path: path.resolve(__dirname, 'dist')
    },
    module: {
      rules: [
        // JS Processing
        {
          test: /\.js$/,
          exclude: /(node_modules|bower_components)/,
          use: [
            // Babel. Transpiles ES6+ code for older browsers.
            // Present env is a smart preset that auto transpiles syntaxes to their readable versions. References browserlist in package.json to know what environments to support.
            // Transform runtime allows us to work with async/await and some newer functionality. Enables the re-use of Babel's injected helper code to save on codesize.
            {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env'],
                plugins: ['@babel/plugin-transform-runtime']
              }
            }
          ]
        },
        // Sass Processing
        {
          test: /\.(sa|sc|c)ss$/,
          use: [
            // Extract css plugin which creates a css file per JS file that contains CSS.
            { loader: MiniCssExtractPlugin.loader },
            {
              loader: 'css-loader', // Translate CSS into CommonJS
              options: {
                url: false // No url processing because all references in css files should be to the root directory. URL processing gets complicated due to MAMP and subfolder setup.
              }
            }, 
            { loader: 'postcss-loader' }, // Process CSS with Post CSS (Autoprefixing, Minifying, etc). Config for this is found in postcss.config.js
            { loader: 'sass-loader' } // Compiles Sass to CSS, using Node Sass by default
          ],
        }
      ]
    },
    plugins: [
      // Extracts css into separate files. Creates a CSS file per JS file that contains CSS.
      new MiniCssExtractPlugin({
        filename: '[name].min.css',
        chunkFilename: '[id].css'
      }),
      // Automatically loaded and universally accessible modules.
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery'
      }),
      new WebpackNotifierPlugin()
    ],
    // Webpack console stats info.
    stats: {
      children: false,
      colors: true,
      errors: true,
      errorDetails: true,
      chunks: false,
      source: false,
      reasons: false,
      entrypoints: devMode ? false : true,
      hash: devMode ? false : true,
      version: devMode ? false : true,
      timings: devMode ? false : true,
      assets: devMode ? false : true,
      modules: devMode ? false : true,
      warnings: devMode ? false : true,
      publicPath: devMode ? false : true
    },
    // Webpack console performance info.
    performance: {
      hints: false
    }
  }
};