<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<main id="main" class="main-wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page-header">
				<?php the_title(); ?>
			</header>

			<div class="page-content">
				<?php the_content(); ?>
			</div>

		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>

	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
