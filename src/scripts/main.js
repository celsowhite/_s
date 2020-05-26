// Styles - Imported here -> Parsed by Sass and PostCSS plugins -> Then extracted to it's own file in dist/main.min.css

import '../styles/main.scss';

// Components

import './components/header';
import './components/social-share';

document.addEventListener('DOMContentLoaded', () => {
  // CSS Vars
  cssVars({});
});
