const path = require('path');

module.exports = function({ file, options, env }) {
	// Env is based on process.env.NODE_ENV. Hence why we set the NODE_ENV and --mode in our package.json.
	return {
		plugins: {
			// Inline @import rules content
			'postcss-import': {},
			// Autoprefix. To edit target browsers: use "browserslist" field in package.json. Don't autoprefix in dev.
			autoprefixer: env === 'development' ? false : {},
			// Minify/Optimize CSS. Don't minify in dev.
			cssnano: env === 'development' ? false : {},
		},
	};
};
