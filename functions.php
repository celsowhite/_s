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
	
	/*==========================================
	MAKE THEME AVAILABLE FOR TRANSLATION
	==========================================*/
	
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;

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
REMOVE WP EMOJI
==========================================*/

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

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
	
	// Default theme style

	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	// Wordpress Default Jquery
	
	if (!is_admin()) {
		wp_deregister_script( 'jquery' );
		wp_deregister_script('jquery-migrate');
    	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), FALSE, NULL, TRUE);
		wp_register_script('jquery-migrate', includes_url('/js/jquery/jquery-migrate.min.js'), FALSE, NULL, TRUE);
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-migrate');
	}

	// Font awesome

	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );

	// Compiled SCSS File

	wp_enqueue_style( 'custom_styles', get_template_directory_uri() . '/css/style.min.css' );

	// Flexslider Styles

	wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider/flexslider.min.css');

	wp_enqueue_script( '_s-flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', '','', true);

	// FitVids

	wp_enqueue_script('_s-fitvids', get_template_directory_uri() . '/js/fitvids/fitvids.min.js', '', '', true);

	// Modernizr (Flexbox & Geolocation Detection)

	wp_enqueue_script( '_s-modernizr', get_template_directory_uri() . '/js/modernizr/modernizr-custom.min.js', '','', true);

	// Custom Scripts

	wp_enqueue_script('_s-scripts', get_template_directory_uri() . '/js/scripts.min.js', '', '', true);

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

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
CUSTOM POST TYPES
==========================================*/

/*=== Stories ===*/

function custom_post_type_stories() {

	$labels = array(
		'name'                => ('Stories'),
		'singular_name'       => ('Stories'),
		'menu_name'           => ('Stories'),
		'parent_item_colon'   => (''),
		'all_items'           => ('All Stories'),
		'view_item'           => ('View Story'),
		'add_new_item'        => ('Add New Story'),
		'add_new'             => ('Add New'),
		'edit_item'           => ('Edit Story'),
		'update_item'         => ('Update Story'),
		'search_items'        => ('Search Stories'),
		'not_found'           => ('Not Found'),
		'not_found_in_trash'  => ('Not found in Trash'),
	);
	
	$args = array(
		'label'               => ('stories'),
		'description'         => ('Stories'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes', 'custom-fields', 'excerpt'  ),
		'hierarchical'        => false,
		'rewrite'             => array('slug' => 'story'),
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

  register_taxonomy('story_type', 'stories', array(

      'hierarchical' => true,
      'labels' => array(
      'name' => ('Type'),
      'singular_name' => ('Type'),
      'search_items' =>  ('Search Types' ),
      'all_items' => ('All Types' ),
      'parent_item' => ('Parent Type' ),
      'parent_item_colon' => ('Parent Type:' ),
      'edit_item' => ('Edit Type' ),
      'update_item' => ('Update Type' ),
      'add_new_item' => ('Add New Type' ),
      'new_item_name' => ('New Type Name' ),
      'menu_name' => ('Types' ),
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
    return 'http://loginurl.com';
}
add_filter('login_headerurl', 'my_loginURL');

// Enque the login specific stylesheet for design customizations. CSS file is compiled through compass.

function my_logincustomCSSfile() {
    wp_enqueue_style('login-styles', get_template_directory_uri() . '/css/login.min.css');
}
add_action('login_enqueue_scripts', 'my_logincustomCSSfile');

/*=============================================
YOAST
=============================================*/

/*=== Adjust Metabox Priority

add_filter( 'wpseo_metabox_prio', function() { return 'low';});

===*/

/*==========================================
INCLUDES
==========================================*/

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
