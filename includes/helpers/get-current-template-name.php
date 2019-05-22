<?php

/**
 * Get Current Template Name
 * Returns the name of the current template based on wp file naming conventions.
 *
 */

function get_current_template_name() {
	global $wp_query;
  
  // Page

  if(is_page()) {
    return basename(get_page_template(), ".php");
  }

  // Single post

  elseif (is_single()) {
    $post_id = $wp_query->get_queried_object_id();
		$post = $wp_query->get_queried_object();
		$post_type = $post->post_type;

    if ( isset( $post->post_type ) ) {
      // If a regular/default post then assign the name as single.
      if($post->post_type === 'post') {
        return 'single';
      }
      // Else use the post type name.
      else {
        return 'single-' . sanitize_html_class( $post->post_type );
      }
    }
  }

  // Search

  elseif ( is_search() ) {
		return 'search';
	}
}

?>
