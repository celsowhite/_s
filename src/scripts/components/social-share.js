/*-------------------------------
Social Share
---
Dynamic facebook and twitter share. The url and text that are shared are set in the DOM using data attributes.
-------------------------------*/

const body = document.querySelector('body');

body.addEventListener('click', function(e) {
	const socialShareLink = e.target.closest('.social-share');

	if (socialShareLink) {
		e.preventDefault();
		const socialShareType = socialShareLink.dataset.shareType;

		// Facebook Share
		if (socialShareType === 'fb') {
			const url = socialShareLink.dataset.url;
			window.open(
				'http://www.facebook.com/sharer.php?u=' + url,
				'facebook_window',
				'height=450, width=550, top=' +
					(window.innerHeight / 2 - 225) +
					', left=' +
					window.innerWidth / 2 +
					', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
			);
		}

		// Twitter Share
		else if (socialShareType === 'twitter') {
			const url = socialShareLink.dataset.url;
			const text = encodeURIComponent(socialShareLink.dataset.text);
			window.open(
				'http://twitter.com/share?url=' + url + '&text=' + text,
				'twitter_window',
				'height=450, width=550, top=' +
					(window.innerHeight / 2 - 225) +
					', left=' +
					window.innerWidth / 2 +
					', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
			);
		}

		// Pinterest Share
		else if (socialShareType === 'pinterest') {
			const url = socialShareLink.dataset.url;
			const media = socialShareLink.dataset.media;
			const description = socialShareLink.dataset.description;
			window.open(
				'http://pinterest.com/pin/create/button/?url=' +
					url +
					'&media=' +
					media +
					'&description=' +
					description,
				'pinterest_window',
				'height=450, width=550, top=' +
					(window.innerHeight / 2 - 225) +
					', left=' +
					window.innerWidth / 2 +
					', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
			);
		}
	}
});
