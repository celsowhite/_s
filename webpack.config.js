const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WebpackNotifierPlugin = require('webpack-notifier');
const AssetsPlugin = require('assets-webpack-plugin');
const glob = require('glob');

module.exports = (env, argv) => {
	// Set Environment

	const devMode = argv.mode !== 'production';

	// Dynamically load entry files. Each page template has their own entry.
	// The main entry is loaded on every page.

	const entries = glob
		.sync('./src/scripts/page-templates/**.js')
		.reduce(function(obj, el) {
			obj[path.parse(el).name] = el;
			return obj;
		}, {});

	entries.main = './src/scripts/main.js';

	// Webpack Config

	return {
		// Entry points. Dynamically created above.
		entry: entries,
		// Output built assets to the dist folder. Use a hash during production.
		output: {
			filename: devMode ? '[name].min.js' : '[name].[hash].min.js',
			path: path.resolve(__dirname, 'dist'),
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
								plugins: ['@babel/plugin-transform-runtime'],
							},
						},
					],
				},
				// Sass Processing
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						// Extract css plugin which creates a css file per JS file that contains CSS.
						{ loader: MiniCssExtractPlugin.loader },
						// Translate CSS into CommonJS
						{
							loader: 'css-loader',
							options: {
								url: false, // No url processing because all references in css files should be to the root directory. URL processing gets complicated due to MAMP and subfolder setup.
							},
						},
						// Process CSS with Post CSS (Autoprefixing, Minifying, etc). Config for this is found in postcss.config.js
						{
							loader: 'postcss-loader',
						},
						// Compiles Sass to CSS, using Node Sass by default
						{ loader: 'sass-loader' },
					],
				},
			],
		},
		plugins: [
			// Extracts css into separate files. Creates a CSS file per JS file that contains CSS.
			// Hashing production output to be able to cache bust in production.
			new MiniCssExtractPlugin({
				filename: devMode ? '[name].min.css' : '[name].[hash].min.css',
				chunkFilename: devMode ? '[id].min.css' : '[id].[hash].min.css',
			}),
			// Mac notifications for js or scss errors. In case terminal isn't visible and need to know if something is wrong.
			new WebpackNotifierPlugin(),
			new AssetsPlugin({
				path: path.resolve(__dirname, 'dist'),
				metadata: {
					env: devMode ? 'dev' : 'prod',
				},
			}),
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
			timings: true,
			assets: devMode ? true : true,
			modules: devMode ? false : true,
			warnings: devMode ? false : true,
			publicPath: devMode ? false : true,
		},
		// Webpack console performance info.
		performance: {
			hints: false,
		},
		// Optimization of bundles.
		optimization: {
			splitChunks: {
				cacheGroups: {
					vendor: {
						test: /[\\/]node_modules[\\/]/,
						name: 'vendor',
						chunks: 'all',
					},
				},
			},
		},
		// Watch options
		watchOptions: {
			// Ignore node_modules folder so the watch mode takes up less CPU.
			ignored: /node_modules/,
		},
	};
};
