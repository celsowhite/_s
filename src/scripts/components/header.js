/*----------------------------
Elements
----------------------------*/

const mobileNavigation = document.querySelector('nav.mobile-navigation');

const menuIcon = document.querySelector('.mobile-header .menu-icon');

/*----------------------------
Mobile Navigation
----------------------------*/

menuIcon.addEventListener('click', function() {
	// Transform the menu icon

	this.classList.toggle('menu-icon--is-crossed');

	// Open the mobile nav drawer

	mobileNavigation.classList.toggle('mobile-navigation--is-open');
});
