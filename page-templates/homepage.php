<?php
/*
Template Name: Homepage
*/

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
