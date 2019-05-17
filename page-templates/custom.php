<?php
/*
Template Name: Custom
*/

get_header(); ?>

  <?php
  $scripts_path = get_template_directory() . '/src/scripts/page-templates';
  $scripts_files = array_diff(scandir($scripts_path), array('.', '..'));
  $script_file_names = [];
  foreach($scripts_files as $script_file) {
    $file_name = str_replace('.js', '', $script_file);
    array_push($script_file_names, $file_name);
  }
  var_dump($script_file_names);

  $path = get_template_directory() . '/page-templates';
  $files = array_diff(scandir($path), array('.', '..'));
  foreach($files as $file) {
    $file_name = str_replace('.php', '', $file);
    if (in_array($file_name, $script_file_names)) {
      echo $file_name;
    }
  }

  echo str_replace('.php', '', basename(get_page_template()));
  ?>

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
