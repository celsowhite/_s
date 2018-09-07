const path = require('path');

module.exports = {
  "plugins": {
    // Inline @import rules content
    "postcss-import": {},
    // Autoprefix. To edit target browsers: use "browserslist" field in package.json
    "autoprefixer": {},
    // Minify/Optimize CSS
    "cssnano": {}
  }
}