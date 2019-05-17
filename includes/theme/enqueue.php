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
	
	// Default theme style

	wp_enqueue_style( 'theme_style', get_stylesheet_uri() );

	// Styles

	wp_enqueue_style( 'main_styles', $scripts_root . $webpack_assets->main->css, '', null);

	// Polyfills

	wp_enqueue_script('polyfill_io', 'https://cdn.polyfill.io/v2/polyfill.js?features=default,fetch,Array.prototype.find,Array.prototype.findIndex,Array.prototype.includes,Object.entries,Element.prototype.closest', '', '', true);

	// Scripts

	wp_enqueue_script('vendor_script', $scripts_root . $webpack_assets->vendor->js, '', null, true);

	$current_page_template_name = str_replace('.php', '', basename(get_page_template()));

	// Save the page template specific script files.

	$script_templates_path = get_template_directory() . '/src/scripts/page-templates';
  $script_template_files = array_diff(scandir($script_templates_path), array('.', '..'));
  $script_template_file_names = [];
  foreach($script_template_files as $script_template_file) {
    $file_name = str_replace('.js', '', $script_template_file);
    array_push($script_template_file_names, $file_name);
  }

	// Gather the page templates and conditionally enqueue script files.

	$page_templates_path = get_template_directory() . '/page-templates';
  $page_template_files = array_diff(scandir($page_templates_path), array('.', '..'));
  foreach($page_template_files as $page_template_file) {
    $file_name = str_replace('.php', '', $page_template_file);
		// If there is a matching script for this page template and the current page matches this template then load it.
		if (in_array($file_name, $script_template_file_names) && $file_name === $current_page_template_name) {
			wp_enqueue_script($file_name . '_script', $scripts_root . $webpack_assets->{$file_name}->js, '', null, true);
		}
  }
	
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