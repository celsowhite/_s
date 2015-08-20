var $j = jQuery.noConflict();

$j(document).ready(function() {

	// Call these functions when the html has loaded.

	"use strict"; // Ensure javascript is in strict mode and catches errors.

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
