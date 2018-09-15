<?php

/*================================= 
Get All Posts
=================================*/

function get_all_posts() {

	$args = array (
		'post_type'         => 'post', 
		'posts_per_page'    => 1
	);
	
	$the_query = new WP_Query($args);

	return $the_query;

}

?>