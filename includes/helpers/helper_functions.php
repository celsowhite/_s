<?php

/*================================= 
Custom Title/Excerpt Lengths
=================================*/

// Title

function title_trim($title) {
	$characters = get_field('title_character_limit', 'option');
	return mb_strimwidth($title, 0, $characters, '...');
}

// Excerpt

function excerpt_trim($excerpt) {
	$characters = get_field('excerpt_character_limit', 'option');
	return mb_strimwidth($excerpt, 0, $characters, '...');
}

/*================================= 
Image ID to URL
=================================*/

// Function to take an image ID parameter and pull the url for a specific size of the image.

function image_id_to_url($imageID, $imageSize) {
	$image = wp_get_attachment_image_src($imageID, $imageSize);
	$image_url = $image[0];
	return $image_url;
}

/*================================= 
Numbered Pagination
=================================*/

// Used within the WP_Query loop or archive pages. Call this function with the $max_pages variable included.

function x_pagination($max_pages) {
	if($max_pages > 1) {
		echo '<section class="ihdf_pagination">';

			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'     => '?paged=%#%',
				'mid_size'   => 1,
				'prev_text'  => '<i class="fa fa-angle-left"></i>',
				'next_text'  => '<i class="fa fa-angle-right"></i>',
				'current'    => max( 1, get_query_var('paged') ),
				'total'      => $max_pages
			) );

		echo '</section>';
	}
}

/*================================= 
Category List
=================================*/

// Create a comma separated list of terms from a specific category
// First variable is the post ID and the second is the registered taxonomy name.

function category_terms_list($postID, $category) {
	$post_terms = get_the_terms($postID, $category);
	$post_terms_list_array = array();
	if($post_terms && ! is_wp_error($post_terms)):
		foreach($post_terms as $term) {
			$post_terms_list_array[] = '<a href="' . get_term_link($term->term_id) . '">' . $term->name . '</a>'; 
		}
		return implode(', ', $post_terms_list_array);
	endif;
}

?>