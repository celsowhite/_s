<?php
if ( ! function_exists( '_s_setup' ) ) :

/*=========================
Sets up theme defaults and registers support for various WordPress features.
 
Note that this function is hooked into the after_setup_theme hook, which
runs before the init hook. The init hook is too late for some features, such
as indicating support for post thumbnails.
========================*/

function _s_setup() {

	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );

	/*==========================================
	LET WORDPRESS MANAGE THE DOCUMENT TITLE
	==========================================*/

	add_theme_support( 'title-tag' );

	/*==========================================
	ENABLE SUPPORT FOR POST THUMBNAILS ON POSTS AND PAGES
	==========================================*/

	add_theme_support( 'post-thumbnails' );

	/*==========================================
	SETUP NAVIGATION MENUS
	==========================================*/

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', '_s' ),
	) );

	/*==========================================
	Switch default core markup for search form, comment form, and comments
	to output valid HTML5.
	==========================================*/

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*==========================================
	ENABLE SUPPORT FOR POST FORMATS
	==========================================*/

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

}
endif;

add_action( 'after_setup_theme', '_s_setup' );

/*==========================================
ENQUEUE SCRIPTS AND STYLES
==========================================*/

function _s_scripts() {

	// Pull Asset filenames from Webpack
	// In production these are hashed for cache busting

	$webpack_assets = json_decode(file_get_contents('dist/webpack-assets.json', true));
	$main_assets = $webpack_assets->main;
	
	// Default theme style

	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	// Font Awesome

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/fontawesome-all.min.css');

	// Styles

	wp_enqueue_style( 'main_styles', get_template_directory_uri() . '/dist/' . $main_assets->css, '', null);

	// Polyfills

	wp_enqueue_script('polyfill_io', 'https://cdn.polyfill.io/v2/polyfill.js?features=default,fetch,Array.prototype.find,Array.prototype.findIndex,Array.prototype.includes,Object.entries,Element.prototype.closest', '', '', true);

	// Scripts

	wp_enqueue_script('main_script', get_template_directory_uri() . '/dist/' . $main_assets->js, '', null, true);

	// Localize main script for accessing Wordpress URLs in JS

	$js_variables = array(
		'site'          => get_option('siteurl'),
		'theme'         => get_template_directory_uri(),
		'ajax_url'      => admin_url('admin-ajax.php')
	);
	
	wp_localize_script('main_script', 'wpUrls', $js_variables);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', '_s_scripts' );

/*==========================================
DASHBOARD
==========================================*/

// Custom Post Types

require get_template_directory() . '/includes/dashboard/custom_post_types.php';

// Widgets & Sidebars

require get_template_directory() . '/includes/dashboard/register_widgets_sidebars.php';

// Clean Admin

require get_template_directory() . '/includes/dashboard/clean_admin.php';

/*==========================================
HELPERS
==========================================*/

// Helper Functions

require get_template_directory() . '/includes/helpers/helper_functions.php';

// Custom template tags for this theme.

require get_template_directory() . '/includes/helpers/template-tags.php';

/*==========================================
PLUGIN CUSTOMIZATION
==========================================*/

// Yoast

require get_template_directory() . '/includes/plugin_customization/yoast.php';

// ACF

require get_template_directory() . '/includes/plugin_customization/acf.php';

/*==========================================
SHORTCODES
==========================================*/

// Custom Shortcodes

require get_template_directory() . '/includes/shortcodes/custom_shortcodes.php';

/*==========================================
FEATURES
==========================================*/

// oEmbed

require get_template_directory() . '/includes/features/oEmbed.php';
