<?php

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
	Let Wordpress Manage The Document Title
	==========================================*/

	add_theme_support( 'title-tag' );

	/*==========================================
	Enable support for post thumbnails on posts and pages.
	==========================================*/

	add_theme_support( 'post-thumbnails' );

	/*==========================================
	Setup Navigation Menus
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
	Enable support for post formats
	==========================================*/

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	/*==========================================
	Enable support for Gutenberg block features
	==========================================*/

	add_theme_support('responsive-embeds');

}

add_action( 'after_setup_theme', '_s_setup' );

?>