<?php
/*
Default page template
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
					<div class="panel">
						<?php
						$all_posts_query = get_all_posts();
						while($all_posts_query->have_posts()): $all_posts_query->the_post(); ?>
							<h2><?php the_title(); ?></h2>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</main>

<?php get_footer(); ?>

