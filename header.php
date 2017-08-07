<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Favicon -->

<link rel="icon" type="img/png" href="<?php echo get_template_directory_uri() . '/favicon.png'; ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="main_header">
		<div class="container">
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo get_template_directory_uri() . '/img/logo/logo.png'; ?>" />
			</a>
			<nav class="main_navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => '' ) ); ?>
			</nav>
		</div>
	</header>

	<header class="mobile_header">
		<div class="container">
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo get_template_directory_uri() . '/img/logo/logo.png'; ?>" />
			</a>
			<span class="menu_icon"></span>
		</div>
	</header>

	<nav class="mobile_navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => '', 'container' => '' ) ); ?>
	</nav>

	<div id="content" class="main_content">