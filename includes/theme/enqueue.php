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

	// Vue App

	if(is_page_template('page-templates/vue-app.php')) {
		
		// Local

		if (strpos($_SERVER["SERVER_NAME"], 'localhost')) {
			wp_enqueue_script('vue_app', 'http://localhost:8080/app.js', '', null, true);
		}

		// Production

		else {
			wp_enqueue_script('vue_app_vendor', get_template_directory_uri() . '/app/dist/js/chunk-vendors.js', '', null, true);
			wp_enqueue_script('vue_app', get_template_directory_uri() . '/app/dist/js/app.js', '', null, true);
		}

	}

	// Localize scripts for accessing Wordpress Data in JS

	$js_variables = array(
		'site'          => get_option('siteurl'),
		'theme'         => get_template_directory_uri(),
		'ajax_url'      => admin_url('admin-ajax.php'),
		'rest_url'      => untrailingslashit(esc_url_raw(rest_url()))
	);
	
	wp_localize_script('vue_app', 'wpData', $js_variables);

	wp_localize_script('main_script', 'wpData', $js_variables);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', '_s_scripts' );

?>