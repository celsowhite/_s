<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<main class="main_wrapper">
			
			<div class="container">
			
				<?php the_content(); ?>

			</div>

		</main>

	<?php endwhile; ?>
	
<?php get_footer(); ?>
