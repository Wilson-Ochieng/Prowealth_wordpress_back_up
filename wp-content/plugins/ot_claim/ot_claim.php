<?php
/*
Plugin Name: OT Claim
Plugin URI: http://oceanthemes.net/
Description: Declares a plugin that will create a custom post type displaying claim.
Version: 1.0
Author: OceanThemes Team
Author URI: http://oceanthemes.net/
License: GPLv2
*/

add_action( 'init', 'codex_claim_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_claim_init() {
	$labels = array(
		'name'               => _x( 'Claims', 'post type general name', 'ot_claim' ),
		'singular_name'      => _x( 'Claim', 'post type singular name', 'ot_claim' ),
		'menu_name'          => _x( 'Claims', 'admin menu', 'ot_claim' ),
		'name_admin_bar'     => _x( 'Claim', 'add new on admin bar', 'ot_claim' ),
		'add_new'            => _x( 'Add New', 'book', 'ot_claim' ),
		'add_new_item'       => __( 'Add New Claim', 'ot_claim' ),
		'new_item'           => __( 'New Claim', 'ot_claim' ),
		'edit_item'          => __( 'Edit Claim', 'ot_claim' ),
		'view_item'          => __( 'View Claim', 'ot_claim' ),
		'all_items'          => __( 'All Claims', 'ot_claim' ),
		'search_items'       => __( 'Search Claims', 'ot_claim' ),
		'parent_item_colon'  => __( 'Parent Claims:', 'ot_claim' ),
		'not_found'          => __( 'No claims found.', 'ot_claim' ),
		'not_found_in_trash' => __( 'No claims found in Trash.', 'ot_claim' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'ot_claim' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'claim' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'claim', $args );
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_claim_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "claim"
function create_claim_taxonomies() {
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
		'rewrite'           => array( 'slug' => 'category_claim' ),
	);

	register_taxonomy( 'category_claim', array( 'claim' ), $args );
}
?>