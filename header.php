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

<link rel="icon" type="img/png" href="" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">

	<header class="site_header" role="banner">
		<nav class="main_navigation" role="navigation">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"></a>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => '' ) ); ?>
		</nav>
	</header>

	<?php wp_nav_menu( array( 'menu' => 'Mobile Menu', 'menu_id' => 'mobile_menu', 'container' => false ) ); ?>

	<div id="content" class="main_content">