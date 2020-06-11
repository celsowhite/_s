<?php

/*==========================================
REMOVE WP EMOJI
==========================================*/

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*=============================================
PAGE EXCERPTS
=============================================*/

function add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'add_excerpts_to_pages' );

/*==========================================
LIMIT POST REVISIONS
==========================================*/

function limit_post_revisions( $num, $post ) {
    $num = 3;
    return $num;
}

add_filter( 'wp_revisions_to_keep', 'limit_post_revisions', 10, 2 );

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
	$webpack_assets = json_decode(file_get_contents(get_template_directory_uri() . '/dist/webpack-assets.json', true));
    wp_enqueue_style('login-styles', get_template_directory_uri() . '/dist/' . $webpack_assets->login->css);
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

/*=======================
Dashboard Main Screen Adjustments
=======================*/

// Add new dashboard widget

/// Function that outputs the contents of the dashboard widget

function dashboard_widget_function( $post, $callback_args ) {
	echo '<img src="' . get_template_directory_uri() . '/screenshot.png" style="width: 100%;" />';
	echo '<p>Welcome to your new wordpress site dashboard. From this area you can edit posts, pages and other components of the site.</p>';
}

/// Function used in the action hook

function add_dashboard_widgets() {
	wp_add_dashboard_widget('dashboard_widget', 'Website Dashboard', 'dashboard_widget_function');
}

/// Register the new dashboard widget with the 'wp_dashboard_setup' action

add_action('wp_dashboard_setup', 'add_dashboard_widgets' );

// Remove Default Widgets

function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   // Right Now
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent Comments
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );  // Incoming Links
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );   // Plugins
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');    // Activity
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal');    // Health Check
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick Press
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );  // Recent Drafts
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );   // WordPress blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );   // Other WordPress News
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' );
	remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'side' );
}

add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

remove_action('welcome_panel', 'wp_welcome_panel');

?>