<?php

/*==========================================
ENQUEUE SCRIPTS AND STYLES
==========================================*/

function _s_scripts() {

	// Pull Asset filenames from Webpack
	// In production these are hashed for cache busting

	$webpack_assets = json_decode(file_get_contents(get_template_directory_uri() . '/dist/webpack-assets.json', true));

	// Set the asset scripts root based on if we are in a dev or prod environment. In dev we are using webpack dev server 
	// so files are served from localhost.

	if($webpack_assets->metadata->env === 'dev') {
		$scripts_root = 'http://localhost:9000/';
	}
	else {
		$scripts_root = get_template_directory_uri() . '/dist/';
	}
	
	// Default theme style

	wp_enqueue_style( 'theme_style', get_stylesheet_uri() );

	// Styles

	wp_enqueue_style( 'main_styles', 'http://localhost:9000/main.min.css', '', null);

	wp_enqueue_style( 'main_styles', $scripts_root . $webpack_assets->main->css, '', null);

	// Polyfills

	wp_enqueue_script('polyfill_io', 'https://cdn.polyfill.io/v2/polyfill.js?features=default,fetch,Array.prototype.find,Array.prototype.findIndex,Array.prototype.includes,Object.entries,Element.prototype.closest', '', '', true);

	// Scripts

	wp_enqueue_script('vendor_script', $scripts_root . $webpack_assets->vendor->js, '', null, true);

	wp_enqueue_script('main_script', $scripts_root . $webpack_assets->main->js, '', null, true);

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