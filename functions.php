<?php
/**
 * _s functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package _s
 */

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

 // Set the content width in pixels, based on the theme's design and stylesheet.

function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/*==========================================
REMOVE WP EMOJI
==========================================*/

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*==========================================
ENQUEUE SCRIPTS AND STYLES
==========================================*/

function _s_scripts() {
	
	// Default theme style

	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	// Wordpress Default Jquery
	
	if (!is_admin()) {
		wp_enqueue_script('jquery');
	}

	// Font Awesome

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/fontawesome-all.min.css');

	// Plugin Styles

	wp_enqueue_style( 'plugin_styles', get_template_directory_uri() . '/styles/plugin_styles.min.css' );

	// Custom Styles

	wp_enqueue_style( 'custom_styles', get_template_directory_uri() . '/styles/custom_styles.min.css' );

	// Polyfills

	wp_enqueue_script('polyfill_io', 'https://cdn.polyfill.io/v2/polyfill.js?features=default,fetch,Array.prototype.find,Array.prototype.findIndex,Array.prototype.includes,Object.entries,Element.prototype.closest', '', '', true);

	// Plugin Scripts

	wp_enqueue_script('plugin_scripts', get_template_directory_uri() . '/scripts/plugin_scripts.min.js', '', '', true);

	// Custom Scripts

	wp_enqueue_script('custom_scripts', get_template_directory_uri() . '/scripts/custom_scripts.min.js', '', '', true);

	// Localize main script for accessing Wordpress URLs in JS

	$js_variables = array(
		'site'          => get_option('siteurl'),
		'theme'         => get_template_directory_uri(),
		'ajax_url'      => admin_url('admin-ajax.php')
	);
	
	wp_localize_script('custom_scripts', 'wpUrls', $js_variables);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', '_s_scripts' );

/*====================================================================

Enqueue Typekit if Neccesary

function theme_typekit() {
    wp_enqueue_script( 'theme_typekit', '//use.typekit.net/mjs0clp.js');
}
add_action( 'wp_enqueue_scripts', 'theme_typekit' );

function theme_typekit_inline() {
  if ( wp_script_is( 'theme_typekit', 'done' ) ) { ?>
  	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php }
}
add_action( 'wp_head', 'theme_typekit_inline' );

====================================================================*/

/*==========================================
LIMIT POST REVISIONS
==========================================*/

function limit_post_revisions( $num, $post ) {
    $num = 3;
    return $num;
}

add_filter( 'wp_revisions_to_keep', 'limit_post_revisions', 10, 2 );

/*=============================================
PAGE EXCERPTS
=============================================*/

function add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'add_excerpts_to_pages' );

/*=============================================
CUSTOM LOGIN SCREEN
=============================================*/

// Change the login logo URL

function my_loginURL() {
    return esc_url( home_url( '/' ) );
}

add_filter('login_headerurl', 'my_loginURL');

// Enqueue the login specific stylesheet for design customizations.

function my_logincustomCSSfile() {
    wp_enqueue_style('login-styles', get_template_directory_uri() . '/styles/login.min.css');
}
add_action('login_enqueue_scripts', 'my_logincustomCSSfile');

/*=============================================
DISALLOW FILE EDIT
Remove the ability to edit theme and plugins via the wp-admin.
=============================================*/

function disable_file_editting() {
  define('DISALLOW_FILE_EDIT', TRUE);
}

add_action('init','disable_file_editting');

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
