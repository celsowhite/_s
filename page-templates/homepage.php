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
					<div class="panel">
						<iframe src="https://www.youtube.com/embed/bTqVqk7FSmY?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
					</div>
					<div class="panel">
						<div class="plyr__video-embed" id="player">
							<iframe src="https://www.youtube.com/embed/bTqVqk7FSmY?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
						</div>
					</div>
					<div class="panel">
						<?php get_template_part('template-parts/components', 'social_share'); ?>
					</div>
					<div class="panel">
						<div class="flexslider">
							<ul class="slides">
								<li><img src="https://celsowhite.com/static/img/websites/rownewyork/featured_image_large.jpg" /></li>
								<li><img src="https://celsowhite.com/static/img/websites/jimmychin/featured_image_large.jpg" /></li>
								<li><img src="https://celsowhite.com/static/img/websites/latinousa/featured_image_large.jpg" /></li>
							</ul>
						</div>
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
