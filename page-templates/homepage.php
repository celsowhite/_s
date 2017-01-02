<?php
/*
Template Name: Homepage
*/

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<main class="main_wrapper">

			<?php

			/* Example WP Query

			$team_loop_args = array ('post_type' => 'people', 'posts_per_page' => -1, 'roles' => 'team');
			$team_loop = new WP_Query($team_loop_args);
			if ($team_loop -> have_posts()) : while ($team_loop -> have_posts()) : $team_loop -> the_post();
			*/
			?>	
			<?php /* endwhile; endif; */?>

		</main>

	<?php endwhile; ?>

<?php get_footer(); ?>
