<?php
/*
Default page template
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
					<div class="panel">
						<?php get_template_part('template-parts/components', 'social_share'); ?>
					</div>
					<div class="panel">
						
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

