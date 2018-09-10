<?php
/*
Template Name: Homepage
*/

get_header(); ?>

	<main class="main_wrapper">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page_header">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="page_content">
				<div class="container">
					<div class="wysiwyg">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

			<?php

			/* Example WP Query

			$team_loop_args = array ('post_type' => 'people', 'posts_per_page' => -1, 'roles' => 'team');
			$team_loop = new WP_Query($team_loop_args);
			if ($team_loop -> have_posts()) : while ($team_loop -> have_posts()) : $team_loop -> the_post();
			*/
			?>	
			<?php /* endwhile; endif; */?>

		<?php endwhile; ?>

	</main>

<?php get_footer(); ?>
