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
REGISTER WIDGET AREA
==========================================*/

function _s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

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

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css');

	// Plugin Styles

	wp_enqueue_style( 'plugin_styles', get_template_directory_uri() . '/styles/plugin_styles.min.css' );

	// Custom Styles

	wp_enqueue_style( 'custom_styles', get_template_directory_uri() . '/styles/custom_styles.min.css' );

	// Plugin Scripts

	wp_enqueue_script('plugin_scripts', get_template_directory_uri() . '/scripts/plugin_scripts.min.js', '', '', true);

	// Custom Scripts

	wp_enqueue_script('custom_scripts', get_template_directory_uri() . '/scripts/custom_scripts.min.js', '', '', true);

	// Localize main script for accessing Wordpress URLs in JS

	$js_variables = array(
		'site'  => get_option('siteurl'),
		'theme' => get_template_directory_uri()
	);
	
	wp_localize_script('_s-scripts', 'wpUrls', $js_variables);

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

/*=============================================
ACF OPTIONS PAGE
=============================================*/

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

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
YOAST
=============================================*/

// Adjust Metabox Priority

add_filter( 'wpseo_metabox_prio', function() { return 'low';});

/*=============================================
DISALLOW FILE EDIT
Remove the ability to edit theme and plugins via the wp-admin.
=============================================*/

function disable_file_editting() {
  define('DISALLOW_FILE_EDIT', TRUE);
}

add_action('init','disable_file_editting');

/*==========================================
INCLUDES
==========================================*/

// Custom Post Types

require get_template_directory() . '/includes/custom_post_types.php';

// Helper Functions

require get_template_directory() . '/includes/helper_functions.php';

// Clean Admin

require get_template_directory() . '/includes/clean_admin.php';

// Custom template tags for this theme.

require get_template_directory() . '/includes/template-tags.php';

// Custom functions that act independently of the theme templates.

require get_template_directory() . '/includes/extras.php';
