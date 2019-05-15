<?php
/**
 * The template for displaying all single posts from a specific custom post types.
 */

get_header(); ?>

	<main class="main-wrapper">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page_header">
				<?php the_title(); ?>
			</header>

			<div class="page_content">
				<?php the_content(); ?>
			</div>

		<?php endwhile; ?>

	</main>

<?php get_footer(); ?>