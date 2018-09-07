import $ from 'jquery';

/*================================= 
MOBILE NAVIGATION REVEAL
=================================*/

var menuIcon = $('.menu_icon');
var mobileNav = $('nav.mobile_navigation ul');

menuIcon.click(function(){
	mobileNav.toggleClass('open');
});