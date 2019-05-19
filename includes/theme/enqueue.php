<?php

/*==========================================
ENQUEUE SCRIPTS AND STYLES
==========================================*/

function _s_scripts() {

	// Pull Asset filenames from Webpack
	// In production these are hashed for cache busting

	$webpack_assets = json_decode(file_get_contents(get_template_directory_uri() . '/dist/webpack-assets.json', true));

	// Scripts Root Directory

	$scripts_root = get_template_directory_uri() . '/dist/';
	
	// Styles

	wp_enqueue_style( 'main', $scripts_root . $webpack_assets->main->css, '', null);

	// Polyfills

	wp_enqueue_script('polyfill_io', 'https://cdn.polyfill.io/v2/polyfill.js?features=default,fetch,Array.prototype.find,Array.prototype.findIndex,Array.prototype.includes,Object.entries,Element.prototype.closest', '', '', true);

	// Scripts

	wp_enqueue_script('vendor', $scripts_root . $webpack_assets->vendor->js, '', null, true);

	$current_page_template_name = str_replace('.php', '', basename(get_page_template()));

	// Gather the templates and conditionally enqueue style/script files.

	$page_templates_path = get_template_directory() . '/page-templates';
  $page_template_files = array_diff(scandir($page_templates_path), array('.', '..'));
  foreach($page_template_files as $page_template_file) {
    $file_name = str_replace('.php', '', $page_template_file);
		// First check if the template name matches the current page template name. We only load style/script files when we need them.
		if($file_name === $current_page_template_name) {
			// Check if there is a js file for this template.
			if(isset($webpack_assets->{$file_name}->js)) {
				wp_enqueue_script($file_name, $scripts_root . $webpack_assets->{$file_name}->js, '', null, true);
			}
			// Check if there is a matching css file for this template.
			if(isset($webpack_assets->{$file_name}->css)) {
				wp_enqueue_style( $file_name, $scripts_root . $webpack_assets->{$file_name}->css, '', null);
			}
		}
  }
	
	wp_enqueue_script('main', $scripts_root . $webpack_assets->main->js, '', null, true);

	// Localize main script for accessing Wordpress URLs in JS

	$js_variables = array(
		'site'          => get_option('siteurl'),
		'theme'         => get_template_directory_uri(),
		'ajax_url'      => admin_url('admin-ajax.php')
	);
	
	wp_localize_script('main', 'wpUrls', $js_variables);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', '_s_scripts' );

?>