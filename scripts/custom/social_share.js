(function($) {

	$(document).ready(function() {

	"use strict";

		/*================================= 
		SOCIAL SHARE
		=================================*/

		// Facebook Share

		$('body').on('click', '.fb_share', function(e) {

			e.preventDefault();

			var url = $(this).data('url');

			window.open('http://www.facebook.com/sharer.php?u=' + url,'facebook_window','height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

		});

		// Twitter Share

		$('body').on('click', '.twitter_share', function (e) {

		    e.preventDefault();

			var url = $(this).data('url');

			var text  = encodeURIComponent($(this).data('text'));
			
			var via = $(this).data('via');

			window.open('http://twitter.com/share?url=' + url + '&text=' + text + '&via=' + via, 'twitter_window', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

		});

		// LinkedIn Share

		$('body').on('click', '.linkedin_share', function (e) {

			e.preventDefault();

			var url = $(this).data('url');

			var title = encodeURIComponent($(this).data('title'));

			window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title, 'linkedin_window', 'height=450, width=550, top=' + ($(window).height() / 2 - 225) + ', left=' + $(window).width() / 2 + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

		});

		// Pinterest Share

		$('body').on('click', '.pinterest_share', function (e) {

			e.preventDefault();

			var url = $(this).data('url');

			var media = $(this).data('media');

			var title = encodeURIComponent($(this).data('title'));

			window.open('http://pinterest.com/pin/create/button/?url=' + url + '&media=' + media + '&description=' + title, 'pinterest_window', 'height=450, width=550, top=' + ($(window).height() / 2 - 225) + ', left=' + $(window).width() / 2 + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

		});

	});

})(jQuery);