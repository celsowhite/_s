Wordpress Starter Theme
===

Modern Wordpress theme setup. Includes webpack setup and some handy default plugins.
- Modular js, ES6+ syntax usage and a single minfied bundle for all js and plugins. 
- Modular scss. Including postcss processing (autoprefixing, imports, minification and optimization.)
- Auto hashing of webpack bundled assets to enable cache busting in production.
- Includes Font Awesome, Flexslider, FitVids and Plyr. These are plugins I use often in projects. Easily choose to include/exclude them through the script files.

## Requirements

- Node.js
- NPM
- PHP

## Getting Started

This package is meant to go in the wp-content/themes folder. Follow the below commands or use my [wp-bash-scripts](https://github.com/celsowhite/wp-bash-scripts) package to automatically scafold a full local WP Install with this theme included.

```bash
git clone https://github.com/celsowhite/wp-starter.git
npm install
```

## Developing Locally
To work on the theme locally run:

```bash
npm run dev
```

This will auto watch all files within the src folder and compile them to the dist folder. Your Wordpress site will load files from the dist folder so just refresh the page when you want to see a change. This does not create a port to view the site. Rather just use your standard port/url setup (MAMP, Vagrant, etc.)

## Building for Production
To create an optimized production build, run:

```bash
npm build
```
## Future Features

- Hot Module Reloading