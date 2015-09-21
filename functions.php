<?php
/**
 * _s functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package _s
 */

if ( ! function_exists( '_s_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _s_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', '_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );


/*==========================================
REGISTER WIDGET AREA
https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
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
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	/*=== Minified Foundation 5 ===*/

	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation/foundation.min.css' );

	wp_enqueue_style( 'foundation_normalize', get_template_directory_uri() . '/css/foundation/normalize.css' );

	/*=== Font Awesome ===*/

	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	/*=== Compiled SCSS File ===*/

	wp_enqueue_style( 'custom_styles', get_template_directory_uri() . '/css/style.css' );

	/*=== Flexslider Styles ===*/

	wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider/flexslider.min.css');

	/*=== Animate CSS ===*/

	wp_enqueue_style('animate_css', get_template_directory_uri() . '/css/animate/animate.min.css');

	/*=== Custom Scripts ===*/

	wp_enqueue_script('_s-scripts', get_template_directory_uri() . '/js/scripts.js', '', '', true);

	/*=== FitVids ===*/

	wp_enqueue_script('_s-fitvids', get_template_directory_uri() . '/js/fitvids/fitvids.min.js', '', '', true);

	/*=== Flexslider JS ===*/

	wp_enqueue_script( '_s-flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', '','', true);

	/*=== Magnific Popup JS ===*/

	wp_enqueue_script( '_s-magnific', get_template_directory_uri() . '/js/magnific/jquery.magnific-popup.min.js', '','', true);

	/*=== Magnific Popup CSS ===*/

	wp_enqueue_style('magnific', get_template_directory_uri() . '/css/magnific/magnific-popup.min.css');

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*=== Wordpress Default Jquery ===*/

	if (!is_admin()) {
		wp_enqueue_script('jquery');
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
CUSTOM POST TYPES
==========================================*/

/*=== Stories ===*/

function custom_post_type_stories() {

	$labels = array(
		'name'                => _x( 'Stories', 'Post Type General Name'),
		'singular_name'       => _x( 'Stories', 'Post Type Singular Name'),
		'menu_name'           => __( 'Stories'),
		'parent_item_colon'   => __( ''),
		'all_items'           => __( 'All Stories'),
		'view_item'           => __( 'View Story'),
		'add_new_item'        => __( 'Add New Story'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Story'),
		'update_item'         => __( 'Update Story'),
		'search_items'        => __( 'Search Stories'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);
	
	$args = array(
		'label'               => __( 'stories'),
		'description'         => __( 'Stories'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes', 'custom-fields', 'excerpt'  ),
		'hierarchical'        => false,
		'taxonomies'          => array( 'story_category' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_icon'  		  => 'dashicons-format-chat',
	);

	register_post_type( 'stories', $args );

}

add_action( 'init', 'custom_post_type_stories', 0 );

/*==========================================
CUSTOM TAXONOMY 
==========================================*/

/*=== Stories Taxonomy ===*/

function add_stories_taxonomies() {

  register_taxonomy('type', 'stories', array(

      'hierarchical' => true,
      'labels' => array(
      'name' => _x( 'Type', 'taxonomy general name' ),
      'singular_name' => _x( 'Type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Types' ),
      'all_items' => __( 'All Types' ),
      'parent_item' => __( 'Parent Type' ),
      'parent_item_colon' => __( 'Parent Type:' ),
      'edit_item' => __( 'Edit Type' ),
      'update_item' => __( 'Update Type' ),
      'add_new_item' => __( 'Add New Type' ),
      'new_item_name' => __( 'New Type Name' ),
      'menu_name' => __( 'Types' ),
    ),

      'rewrite' => array(
      'slug' => 'type', 
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action( 'init', 'add_stories_taxonomies', 0 );

/*=============================================
ACF OPTIONS PAGE
=============================================*/

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();
	
}

/*=============================================
CUSTOM LOGIN SCREEN
=============================================*/

// Change the login logo URL

function my_loginURL() {
    return 'http://loginurl.com';
}
add_filter('login_headerurl', 'my_loginURL');

// Enque the login specific stylesheet for design customizations. CSS file is compiled through compass.

function my_logincustomCSSfile() {
    wp_enqueue_style('login-styles', get_template_directory_uri() . '/css/login.css');
}
add_action('login_enqueue_scripts', 'my_logincustomCSSfile');


/*==========================================
INCLUDES
==========================================*/

/*== Theme Options ==*/

require_once ( get_template_directory() . '/inc/theme-options.php' );

/*== Implement the Custom Header feature. ==*/

require get_template_directory() . '/inc/custom-header.php';

/*== Custom template tags for this theme. ==*/

require get_template_directory() . '/inc/template-tags.php';

/*== Custom functions that act independently of the theme templates. ==*/

require get_template_directory() . '/inc/extras.php';

/*== Customizer additions. ==*/

require get_template_directory() . '/inc/customizer.php';

/*== Load Jetpack compatibility file. ==*/

require get_template_directory() . '/inc/jetpack.php';
