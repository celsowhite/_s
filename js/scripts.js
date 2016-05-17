var $j = jQuery.noConflict();

$j(document).ready(function() {

	// Call these functions when the html has loaded.

	"use strict"; // Ensure javascript is in strict mode and catches errors.

	/*================================= 
	MOBILE MENU DRAWER
	=================================*/

	$j('a.nav_item.menu_icon').click(function(e){
		e.preventDefault();
		$j('ul#mobile_menu').toggleClass('open');
	});

	/*================================= 
	SOCIAL SHARE
	=================================*/

	/*== Facebook Share ==*/

	$j('a.fb_share').click(function(e) {

		e.preventDefault();

		var loc = $j(this).attr('href');

		window.open('http://www.facebook.com/sharer.php?u=' + loc,'facebookwindow','height=450, width=550, top='+($j(window).height()/2 - 225) +', left='+$j(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

	});

	$j('a.twitter_share').click(function(e){

	    e.preventDefault();

	    var loc = $j(this).attr('href');

	    var via = $j(this).attr('via');

	    var title  = encodeURIComponent($j(this).attr('title'));

	    window.open('http://twitter.com/share?url=' + loc + '&via=' + via, 'twitterwindow', 'height=450, width=550, top='+($j(window).height()/2 - 225) +', left='+$j(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

	});

	/*=== LinkedIn Share ===*/

	$j('a.linkedin_share').click(function(e){

		e.preventDefault();

		var loc = $j(this).attr('href');

		var title = encodeURIComponent($j(this).attr('title'));

		var excerpt  = encodeURIComponent($j(this).attr('excerpt'));

		window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + loc + '&title=' + title + '&summary=' + excerpt);

	});

	/*================================= 
	FITVIDS
	=================================*/

	/*=== Wrap All Iframes with 'video_embed' for responsive videos ===*/

	$j('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').wrap("<div class='video_embed'/>");

	/*=== Target div for fitVids ===*/

	$j(".video_embed").fitVids();

});

$j(window).load(function() {

	// Call these functions when the complete page (html and images) has loaded.

	"use strict"; // Ensure javascript is in strict mode and catches errors.

	// Example Flexslider Setup

    $j('.story_slider').flexslider({
    	animation: "fade",
    	controlNav: false
    });
  
});
