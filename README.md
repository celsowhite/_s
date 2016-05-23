Developer Note
===

Wordpress theme for [project name]. Uses Gulp as a build tool. Gulp parses the scss file, autoprefixes, renames and minifies the style.scss, login.scss and scripts.js files.

Within the theme is fontawesome, flexslider, fitVids and some other useful scripts and plugins I typically use on projects.

This will keep evolving!

Installation (for when the site has been deployed)
===

- Download the newest version of Wordpress.
- Download the database from the live server. 
- Upload the database to your local phpMyAdmin. Do a search and replace on the database to update the URL's.
- Setup the wp-config file with your db credentials.
- Download or clone this repository into wp-content/themes.
- Do a manual download of the wp-content/plugins and wp-content/uploads from the live server. Upload the files locally.
- Activate the theme.
- If you plan to use Gulp as your build tool, make sure node, sass and gulp are installed on your local machine.
- Run npm install.
- Run gulp.
- Start making adjustments.



