<?php

/*==========================================
Modify Oembed
---
In some cases we want to modify the oembed output for specific content. Changing the parameters
and specific functionality.
==========================================*/

function modifyOembedHtml( $cache, $url, $attr, $post_ID ) {
	    
	// Modify youtube params. Ensure no related videos appear after the video is done playing.
    
	if ( strstr( $cache, 'youtube.com/embed/' ) ) {
		$cache = str_replace( '?feature=oembed', '?rel=0', $cache );
	}
	
	// Return the modified oEmbed html
    
	return $cache;

}

add_filter( 'embed_oembed_html', 'modifyOembedHtml', 10, 4 );

?>