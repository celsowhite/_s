<?php
/*
Default page template
*/

get_header(); ?>

	<main class="main_wrapper">

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

