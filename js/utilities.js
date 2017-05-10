/*================================= 
DEBOUCE
=================================*/

// Handle taxing js tasks
// https://davidwalsh.name/javascript-debounce-function

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

/*================================= 
MEDIA QUERIES
=================================*/

// Interactions just for desktop

const mq = window.matchMedia( "(min-width: 1024px)" );

/*================================= 
POLYFILLS
=================================*/

// Closest Polyfill for IE
// https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
		
if (window.Element && !Element.prototype.closest) {
    Element.prototype.closest = 
    function(s) {
        var matches = (this.document || this.ownerDocument).querySelectorAll(s),
            i,
            el = this;
        do {
            i = matches.length;
            while (--i >= 0 && matches.item(i) !== el) {};
        } while ((i < 0) && (el = el.parentElement)); 
        return el;
    };
}