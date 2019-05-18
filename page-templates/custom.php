<?php
/*
Template Name: Custom
*/

get_header(); ?>

	<main class="main-wrapper">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page-header">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="page-content">
				<div class="container">
					<div class="wysiwyg">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</main>

<?php get_footer(); ?>
