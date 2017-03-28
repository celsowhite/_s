<?php

/*==========================================
LECTURES
==========================================*/

// Post Type

function custom_post_type_lectures() {

	$labels = array(
		'name'                => ('Lectures'),
		'singular_name'       => ('Lecture'),
		'menu_name'           => ('Lectures'),
		'parent_item_colon'   => (''),
		'all_items'           => ('All Lectures'),
		'view_item'           => ('View Lecture'),
		'add_new_item'        => ('Add New Lecture'),
		'add_new'             => ('Add New'),
		'edit_item'           => ('Edit Lecture'),
		'update_item'         => ('Update Lecture'),
		'search_items'        => ('Search Lectures'),
		'not_found'           => ('Not Found'),
		'not_found_in_trash'  => ('Not found in Trash'),
	);
	
	$args = array(
		'label'               => ('lectures'),
		'description'         => ('Lectures'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt'),
		'hierarchical'        => false,
		'rewrite'             => array('slug' => 'lecture'),
		'taxonomies'          => array('post_tag', 'nyss_lecture_season'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_position'       => 20,
		'menu_icon'  		  => 'dashicons-format-status',
	);

	register_post_type( 'nyss_lecture', $args );

}

add_action( 'init', 'custom_post_type_lectures', 0 );

// Season Taxonomy

function add_lecture_season_taxonomy() {
	$labels = array(
		'name' => ('Season'),
      	'singular_name' => ('Season'),
      	'search_items' =>  ('Search Seasons' ),
      	'all_items' => ('All Seasons' ),
      	'parent_item' => ('Parent Season' ),
      	'parent_item_colon' => ('Parent Season:' ),
      	'edit_item' => ('Edit Season' ),
      	'update_item' => ('Update Season' ),
      	'add_new_item' => ('Add New Season' ),
      	'new_item_name' => ('New Season' ),
      	'menu_name' => ('Seasons' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'lectures/season' ),
	);

	register_taxonomy( 'nyss_lecture_season', array('nyss_lecture'), $args );
}

add_action( 'init', 'add_lecture_season_taxonomy', 0 );

?>