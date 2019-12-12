<?php

/*==========================================
Helpers
==========================================*/

// Get current page template name

require get_template_directory() . '/includes/helpers/get-current-template-name.php';

/*==========================================
Enqueue Scripts & Styles
==========================================*/

function _s_scripts() {

	// Pull Asset filenames from Webpack
	// In production these are hashed for cache busting

	$webpack_assets = json_decode(file_get_contents(get_template_directory_uri() . '/dist/webpack-assets.json', true));

	// Scripts Root Directory

	$scripts_root = get_template_directory_uri() . '/dist/';
	
	// Polyfills

	wp_enqueue_script('polyfill_io', 'https://cdn.polyfill.io/v2/polyfill.js?features=default,fetch,Array.prototype.find,Array.prototype.findIndex,Array.prototype.includes,Object.entries,Element.prototype.closest', '', '', true);

	// Vendor Styles/Scripts - Universally Loaded

	if(isset($webpack_assets->vendor->css)) {
		wp_enqueue_style( 'vendor', $scripts_root . $webpack_assets->vendor->css, '', null);
	}
	if(isset($webpack_assets->vendor->js)) {
		wp_enqueue_script( 'vendor', $scripts_root . $webpack_assets->vendor->js, '', null, true);
	}

	// Main Styles/Scripts - Universally Loaded

	if(isset($webpack_assets->main->css)) {
		wp_enqueue_style( 'main', $scripts_root . $webpack_assets->main->css, '', null);
	}
	if(isset($webpack_assets->main->js)) {
		wp_enqueue_script('main', $scripts_root . $webpack_assets->main->js, '', null, true);
	}

	// Template Styles/Scripts

	$current_template_name = get_current_template_name();

	// Gather the templates and conditionally enqueue style/script files.

	$script_templates_path = get_template_directory() . '/src/scripts/templates';
	$script_template_files = array_diff(scandir($script_templates_path), array('.', '..'));

  foreach($script_template_files as $script_template_file) {
		// Remove the js extension from the file name.
    $file_name = str_replace('.js', '', $script_template_file);

		// If the template name doesn't match the current page template name then don't load it.
		if($file_name !== $current_template_name) continue;
		
		// Check if there is a matching css file for this template.
		if(isset($webpack_assets->{$file_name}->css)) {
			wp_enqueue_style( $file_name, $scripts_root . $webpack_assets->{$file_name}->css, '', null);
		}

		// Check if there is a js file for this template.
		if(isset($webpack_assets->{$file_name}->js)) {
			wp_enqueue_script($file_name, $scripts_root . $webpack_assets->{$file_name}->js, '', null, true);
		}
  }
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', '_s_scripts' );

?>