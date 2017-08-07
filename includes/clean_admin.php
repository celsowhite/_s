<?php

/*---------------------
Dashboard Menu Adjustments
---------------------*/

// Only hide specific dashboard menu items on the live server.
// Show on localhost.

$whitelist = array('127.0.0.1','::1');

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    add_action( 'admin_menu', 'my_remove_menu_pages', 999 );

	function my_remove_menu_pages() {
		remove_menu_page( 'wpseo_dashboard');
		// Enable if no comments on site remove_menu_page( 'edit-comments.php' );          
		remove_menu_page( 'tools.php' );               
		remove_menu_page( 'wpcf7' );
	};
}

/*---------------------
Dashboard Main Screen Adjustments
---------------------*/

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