<?php
/**
* Basic Taxonomy Template
 */

get_header(); ?>
	
	<main class="main-wrapper">

		<header class="page_header">
			<h1><?php single_term_title(); ?></h1>
			<p><?php echo term_description(); ?></p>
		</header>

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page_header">
				<h3><?php the_title(); ?></h3>
			</header>

			<div class="page_content">
				<?php the_content(); ?>
			</div>

		<?php endwhile; ?>

	</main>

<?php get_footer(); ?>