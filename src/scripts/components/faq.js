/*================================= 
FAQ Expand
=================================*/

// Find all of the FAQ's on the page.

const faqs = document.querySelectorAll('.faq');

Array.from(faqs).forEach((faq) => {

    // Add a click event listener to each.

    faq.addEventListener('click', (e) => {

        // Toggle the open state on click.

        faq.classList.toggle('open');

    });

});