<?php
/*
Plugin Name: OT Careers
Plugin URI: http://oceanthemes.net/
Description: Declares a plugin that will create a custom post type displaying career.
Version: 1.0
Author: OceanThemes Team
Author URI: http://oceanthemes.net/
License: GPLv2
*/

add_action( 'init', 'codex_career_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_career_init() {
	$labels = array(
		'name'               => _x( 'Careers', 'post type general name', 'ot_career' ),
		'singular_name'      => _x( 'Career', 'post type singular name', 'ot_career' ),
		'menu_name'          => _x( 'Careers', 'admin menu', 'ot_career' ),
		'name_admin_bar'     => _x( 'Career', 'add new on admin bar', 'ot_career' ),
		'add_new'            => _x( 'Add New', 'book', 'ot_career' ),
		'add_new_item'       => __( 'Add New Career', 'ot_career' ),
		'new_item'           => __( 'New Career', 'ot_career' ),
		'edit_item'          => __( 'Edit Career', 'ot_career' ),
		'view_item'          => __( 'View Career', 'ot_career' ),
		'all_items'          => __( 'All Careers', 'ot_career' ),
		'search_items'       => __( 'Search Careers', 'ot_career' ),
		'parent_item_colon'  => __( 'Parent Careers:', 'ot_career' ),
		'not_found'          => __( 'No books found.', 'ot_career' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'ot_career' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'ot_career' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'career' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'career', $args );
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_career_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "career"
function create_career_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category_career' ),
	);

	register_taxonomy( 'category_career', array( 'career' ), $args );
}
?>