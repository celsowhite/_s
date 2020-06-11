// Styles - Imported here -> Parsed by Sass and PostCSS plugins -> Then extracted to it's own file in dist/main.min.css

import '../styles/main.scss';

// Components

import './components/header';
import './components/social-share';

// Helpers

import cssVars from 'css-vars-ponyfill';

document.addEventListener('DOMContentLoaded', () => {
  // CSS Vars
  cssVars({});
});
