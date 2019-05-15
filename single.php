<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

	<main class="main-wrapper">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page-header">
				<?php the_title(); ?>
			</header>

			<div class="page-content wysiwyg">
				<?php the_content(); ?>
			</div>
			
		<?php endwhile; ?>

	</main>
	
<?php get_footer(); ?>