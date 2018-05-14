<?php

/*==========================================
FAQ
==========================================*/

// FAQ Start

function rny_faq_start_shortcode( $atts, $content = null ) {

    return '<div class="rny_faq_container">';

}

add_shortcode('rny_faq_start', 'rny_faq_start_shortcode');

// FAQ End

function rny_faq_end_shortcode( $atts, $content = null ) {

    return '</div>';

}

add_shortcode('rny_faq_end', 'rny_faq_end_shortcode');

// FAQ Panel

function rny_faq_shortcode( $atts, $content = null ) {

    $a = shortcode_atts( array(
        'title'    => ''
    ), $atts );

    return '<div class="rny_faq"><h5 class="rny_faq_title">' . $a["title"] . '</h5><div class="rny_faq_content">' . $content . '</div></div>';

}

add_shortcode('rny_faq', 'rny_faq_shortcode');

?>