(function($) {

	$(document).ready(function() {

	"use strict";

		/*================================= 
		FITVIDS
		=================================*/

		// Wrap All Iframes with 'video_embed' for responsive videos

		$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').wrap("<div class='video_embed'/>");

		// Target div for fitVids

		$(".video_embed").fitVids();

	});

})(jQuery);


