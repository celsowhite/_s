<?php

/*==========================================
ENQUEUE SCRIPTS AND STYLES
==========================================*/

function _s_scripts() {

	// Pull Asset filenames from Webpack
	// In production these are hashed for cache busting

	$webpack_assets = json_decode(file_get_contents(get_template_directory_uri() . '/dist/webpack-assets.json', true));
	$main_assets = $webpack_assets->main;
	
	// Default theme style

	wp_enqueue_style( 'theme_style', get_stylesheet_uri() );

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

?>