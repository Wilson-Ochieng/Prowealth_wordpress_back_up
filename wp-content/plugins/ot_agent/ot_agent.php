<?php
/*
Plugin Name: OT Agents
Plugin URI: http://oceanthemes.net/
Description: Declares a plugin that will create a custom post type displaying agent.
Version: 1.0
Author: OceanThemes Team
Author URI: http://oceanthemes.net/
License: GPLv2
*/

add_action( 'init', 'register_ocean_agent' );

function register_ocean_agent() {

    $labels = array( 

        'name' => __( 'Agents', 'ot_agent' ),

        'singular_name' => __( 'Agent', 'ot_agent' ),

        'add_new' => __( 'Add New Agent', 'ot_agent' ),

        'add_new_item' => __( 'Add New Agent', 'ot_agent' ),

        'edit_item' => __( 'Edit Agent', 'ot_agent' ),

        'new_item' => __( 'New Agent', 'ot_agent' ),

        'view_item' => __( 'View Agent', 'ot_agent' ),
		'all_items'          => __( 'All Agents', 'ot_agent' ),
        'search_items' => __( 'Search Agents', 'ot_agent' ),

        'not_found' => __( 'No Agents found', 'ot_agent' ),

        'not_found_in_trash' => __( 'No Agents found in Trash', 'ot_agent' ),

        'parent_item_colon' => __( 'Parent Agent:', 'ot_agent' ),

        'menu_name' => __( 'Agents', 'ot_agent' ),

    );



    $args = array( 

        'labels' => $labels,

        'hierarchical' => true,

        'description' => 'List Agent',

        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats', 'excerpt' ),

        'taxonomies' => array('category_agent' ),

        'public' => true,

        'show_ui' => true,

        'show_in_menu' => true,     
        'menu_position' => null,  

        'menu_icon' => 'dashicons-groups',	

        'show_in_nav_menus' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'has_archive' => true,

        'query_var' => true,

        'can_export' => true,

        'rewrite' => true,

        'capability_type' => 'post'

    );



    register_post_type( 'agent', $args );

}

add_action( 'init', 'agent_category_hierarchical_taxonomy', 0 );



//create a custom taxonomy name it Skillss for your posts



function agent_category_hierarchical_taxonomy() {



// Add new taxonomy, make it hierarchical like Category

//first do the translations part for GUI



  $labels = array(

    'name' => __( 'Categories', 'ot_agent' ),

    'singular_name' => __( 'Categories', 'ot_agent' ),

    'search_items' =>  __( 'Search Categories','ot_agent' ),

    'all_items' => __( 'All Categories','ot_agent' ),

    'parent_item' => __( 'Parent Categories','ot_agent' ),

    'parent_item_colon' => __( 'Parent Categories:','ot_agent' ),

    'edit_item' => __( 'Edit Category','ot_agent' ), 

    'update_item' => __( 'Update Category','ot_agent' ),

    'add_new_item' => __( 'Add New Category','ot_agent' ),

    'new_item_name' => __( 'New Category Name','ot_agent' ),

    'menu_name' => __( 'Categories','ot_agent' ),

  );     



// Now register the taxonomy



  register_taxonomy('category_agent',array('agent'), array(

    'hierarchical' => true,

    'labels' => $labels,

    'show_ui' => true,

    'show_admin_column' => true,

    'query_var' => true,

    'rewrite' => array( 'slug' => 'category_agent' ),

  ));

// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'States', 'taxonomy general name' ),
		'singular_name'     => _x( 'State', 'taxonomy singular name' ),
		'search_items'      => __( 'Search States' ),
		'all_items'         => __( 'All States' ),
		'parent_item'       => __( 'Parent State' ),
		'parent_item_colon' => __( 'Parent State:' ),
		'edit_item'         => __( 'Edit State' ),
		'update_item'       => __( 'Update State' ),
		'add_new_item'      => __( 'Add New State' ),
		'new_item_name'     => __( 'New State Name' ),
		'menu_name'         => __( 'States' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'state' ),
	);

	register_taxonomy( 'state', array( 'agent' ), $args );  

}

?>