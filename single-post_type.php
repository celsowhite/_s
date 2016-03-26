<?php
/**
 * The template for displaying all single posts from a specific custom post types.
 */

get_header(); ?>

	<main id="main post-<?php the_ID(); ?>" class="main_wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page_header">
				<?php the_title(); ?>
			</header>

			<div class="page_content">
				<?php the_content(); ?>
			</div>

			<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; ?>

	</main>

<?php get_footer(); ?>